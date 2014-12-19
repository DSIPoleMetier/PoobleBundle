<?php

namespace Lyon1\Bundle\PoobleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SurveyConfigureDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('items', 'collection', 
                array(
                    'type' => new SurveyItemDateType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /*
        $resolver->setDefaults(array(
            'data_class' => 'Lyon1\Bundle\PoobleBundle\Entity\Survey'
        ));
        */
    }

    public function getName()
    {
        return 'configure_date';
    }
}
