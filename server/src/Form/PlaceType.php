<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('siret')
            ->add('adress')
            ->add('city')
            ->add('zipcode')
            ->add('email')
            ->add('description')
            ->add('website')
            ->add('image')
            ->add('isActive')
            ->add('status')
            ->add('createdAt')
            ->add('facebook')
            // ->add('AppUserCreator')
            ->add('PlaceType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
