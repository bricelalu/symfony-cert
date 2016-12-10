<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function  buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('characterName', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('isMainCharacter', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType',
                array('required' => false))
            ->add('rating', 'Symfony\Component\Form\Extension\Core\Type\IntegerType')
            ->add('releasedAt', 'Symfony\Component\Form\Extension\Core\Type\DateType',
                array('widget' => 'single_text'))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Movie'
        ));
    }

    public function getName()
    {
        return 'app_bundle_movie_type';
    }
}
