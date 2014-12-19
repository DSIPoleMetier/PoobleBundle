<?php

namespace Lyon1\Bundle\PoobleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lyon1\Bundle\PoobleBundle\Form\DataTransformer\DateToStringTransformer;

class SurveyItemDateType extends SurveyItemType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $transformer = new DateToStringTransformer();

        $builder
            ->add(
                $builder->create('name', 'date')
                    ->addModelTransformer($transformer)
            )
            ->add('description', 'times_selector')
            // ->add('description')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lyon1_bundle_pooblebundle_surveyitemdate';
    }
}
