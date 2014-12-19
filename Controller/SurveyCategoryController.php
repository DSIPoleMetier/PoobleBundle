<?php

namespace Lyon1\Bundle\PoobleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lyon1\Bundle\PoobleBundle\Entity\SurveyCategory;
use Lyon1\Bundle\PoobleBundle\Form\SurveyCategoryType;

/**
 * SurveyCategory controller.
 *
 * @Route("/surveycategory")
 */
class SurveyCategoryController extends Controller
{

    /**
     * Lists all SurveyCategory entities.
     *
     * @Route("/", name="surveycategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PoobleBundle:SurveyCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SurveyCategory entity.
     *
     * @Route("/", name="surveycategory_create")
     * @Method("POST")
     * @Template("PoobleBundle:SurveyCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SurveyCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('surveycategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a SurveyCategory entity.
     *
     * @param SurveyCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SurveyCategory $entity)
    {
        $form = $this->createForm(new SurveyCategoryType(), $entity, array(
            'action' => $this->generateUrl('surveycategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SurveyCategory entity.
     *
     * @Route("/new", name="surveycategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SurveyCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SurveyCategory entity.
     *
     * @Route("/{id}", name="surveycategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PoobleBundle:SurveyCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SurveyCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SurveyCategory entity.
     *
     * @Route("/{id}/edit", name="surveycategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PoobleBundle:SurveyCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SurveyCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a SurveyCategory entity.
    *
    * @param SurveyCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SurveyCategory $entity)
    {
        $form = $this->createForm(new SurveyCategoryType(), $entity, array(
            'action' => $this->generateUrl('surveycategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SurveyCategory entity.
     *
     * @Route("/{id}", name="surveycategory_update")
     * @Method("PUT")
     * @Template("PoobleBundle:SurveyCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PoobleBundle:SurveyCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SurveyCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('surveycategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SurveyCategory entity.
     *
     * @Route("/{id}", name="surveycategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PoobleBundle:SurveyCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SurveyCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('surveycategory'));
    }

    /**
     * Creates a form to delete a SurveyCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('surveycategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
