<?php

namespace Lyon1\Bundle\PoobleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SurveyAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $answer = $builder->getData();
        $builder->add('name');
        
        foreach ($answer->getSurvey()->getItems() as $item) {
            $builder->add('item_'.$item->getId(), 'checkbox', array(
                'mapped' => false,
                'required' => false
            ));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lyon1\Bundle\PoobleBundle\Entity\SurveyAnswer'
        ));
    }

    public function getName()
    {
        return 'lyon1_bundle_pooblebundle_surveyanswer';
    }
}
