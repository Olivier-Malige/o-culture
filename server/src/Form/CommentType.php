<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextType::class, array(
                'label' => 'Contenu',
            ))
            ->add('isActive', CheckboxType::class, array(
                'label'    => 'Actif',
                'required' => false,
            ))
            ->add('status')
            ->add('Event', EntityType::class, array(
                'class' => Event::class,
                'label' => 'Événement',
            ))
            ->add('Place', EntityType::class, array(
                'class' => Place::class,
                'label' => 'Lieu',
            ))
            // ->add('AppUser', EntityType::class, array(
            //     'class' => AppUser::class,
            //     'label' => 'Auteur',
            // ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
