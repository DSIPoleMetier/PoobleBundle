<?php

namespace Lyon1\Bundle\PoobleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Lyon1\Bundle\PoobleBundle\Entity\Survey;
use Lyon1\Bundle\PoobleBundle\Entity\SurveyItem;
use Lyon1\Bundle\PoobleBundle\Form\SurveyType;
use Lyon1\Bundle\PoobleBundle\Factory\SurveyConfigureTypeFactory;

/**
 * @Route("{_locale}")
 */
class WizardSurveyController extends Controller
{
    /**
     * @Route("/new", name="pooble_new")
     * @Template()
     */
    public function newAction(Request $request)
    {        
        $session = $request->getSession();

        $survey = new Survey();
        if ($session->has('pending_survey')) {
            $survey = $session->get('pending_survey');
            $survey = $this->getDoctrine()->getManager()->merge($survey);
        }

        $form = $this->createForm(new SurveyType(), $survey);
        $form->add('next', 'submit');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $session->set('pending_survey', $form->getData());

            return $this->redirect($this->generateUrl('pooble_new_configure'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/new/configure", name="pooble_new_configure")
     * @Template()
     */
    public function newConfigureAction(Request $request)
    {
        $survey = $request->getSession()->get('pending_survey');
        $em = $this->getDoctrine()->getManager();
        $survey = $em->merge($survey);

        if ( count( $survey->getItems() ) == 0 ) {
            $item = new SurveyItem();
            $survey->addItem($item);
        }

        $form = $this->createForm($survey->getCategory()->getType(), $survey);        
        $form->add('back', 'submit', array('attr' => array('formnovalidate' => 'true')));
        $form->add('end', 'submit');

        $form->handleRequest($request);

        if ($form->get('back')->isClicked()) {            
            return $this->redirect($this->generateUrl('pooble_new'));
        }

        if ($form->isValid()) {
            // var_dump(count($survey->getItems()));die;
            /**
             * Hugly hack due to Doctrine bug:
             * http://www.doctrine-project.org/jira/browse/DDC-2406
             */
            $survey
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setToken($this->container->get('pooble.tokenizer')->generateToken($survey))
            ;
            // End
            $em->flush();

            return $this->redirect($this->generateUrl('pooble_created', array(
                'token' => $survey->getToken()
            )));
        }

        return array(
            'form' => $form->createView(),
            'form_type' => $survey->getCategory()->getType(),
        );
    }

    /**
     * @Route("/created/{token}", name="pooble_created")
     * @Template()
     */
    public function createdAction(Request $request, $token)
    {
        $request->getSession()->remove('pending_survey');

        $em = $this->getDoctrine()->getManager();
        $survey = $em->getRepository('PoobleBundle:Survey')->findOneBy(array('token' => $token));
        if (null == $survey) {
            throw $this->createNotFoundException("token invalide");
        }

        return array('survey' => $survey);
    }
}
