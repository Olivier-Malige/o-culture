<?php

namespace App\Form;

use App\Entity\AppUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AppUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'Pseudo',
            ))
            ->add('email')
            ->add('password', TextType::class, array(
                'label' => 'Mot de passe',
            ))
            ->add('name', TextType::class, array(
                'label' => 'Nom',
            ))
            ->add('city', TextType::class, array(
                'label' => 'Ville',
            ))
            ->add('zipcode', TextType::class, array(
                'label' => 'Code Postal',
            ))
            ->add('role')
            ->add('status')
            ->add('isActive', CheckboxType::class, array(
                'label'    => 'Actif',
                'required' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppUser::class,
        ]);
    }
}
