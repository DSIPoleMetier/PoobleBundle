<?php 

namespace Lyon1\Bundle\PoobleBundle\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Lyon1\Bundle\PoobleBundle\Entity\Survey;

class SurveySubscriber implements EventSubscriber
{
    private $tokenizer;

    public function __construct($tokenizer)
    {        
        $this->tokenizer = $tokenizer;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist'
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

    /*
        if ($entity instanceof Survey) {                    
            $entity
                ->setToken($this->tokenizer->generateToken($entity))                   
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
            ;
            var_dump($entity->getToken());
        }
    */
    }
}
