<?php

namespace Lyon1\Bundle\PoobleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('name')
            ->add('category', 'entity', array(
                'class'    => 'PoobleBundle:SurveyCategory',
                'expanded' => true,
                'multiple' => false
                //'property' => 'name'
            ))
            ->add('location')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lyon1\Bundle\PoobleBundle\Entity\Survey'
        ));
    }

    public function getName()
    {
        return 'lyon1_bundle_pooblebundle_survey';
    }
}
