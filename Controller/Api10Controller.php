<?php

namespace Lyon1\Bundle\PoobleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/1.0")
 */
class Api10Controller extends Controller
{
    /**
     * @Route("/surveys")
     */
    public function surveysAction()
    {
        $em = $this->getDoctrine()->getManager();
        $surveys = $em->getRepository('PoobleBundle:Survey')->findAll();

        $ret = array();
        foreach($surveys as $survey) {
            $ret[] = array(
                'id'   => $survey->getId(),
                'name' => $survey->getName()
            );
        }

        return new Response(
            json_encode($ret),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}

