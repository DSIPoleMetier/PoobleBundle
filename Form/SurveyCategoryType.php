<?php

namespace Lyon1\Bundle\PoobleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SurveyCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('name')
            ->add('type', 'choice', array(
                'choices' => array(
                    'configure_date'   => 'date',
                    'configure_choice' => 'choice'
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lyon1\Bundle\PoobleBundle\Entity\SurveyCategory'
        ));
    }

    public function getName()
    {
        return 'lyon1_bundle_pooblebundle_surveycategory';
    }
}
