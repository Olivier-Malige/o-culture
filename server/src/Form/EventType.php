<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\AppUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom de l\'événement',
            ))
            ->add('plannedDate', DateTimeType::class, array(
                'label' => 'Date de l\'événement',
            ))
            ->add('nbSpectator', TextType::class, array(
                'label' => 'Nombre de spectateurs',
            ))
            ->add('price', TextType::class, array(
                'label' => 'Prix',
            ))
            ->add('description')
            ->add('image')
            ->add('status')
            ->add('isActive', CheckboxType::class, array(
                'label'    => 'Actif',
                'required' => false,
            ))
            // ->add('appUserCreator', EntityType::class, array(
            //     'class' => AppUser::class,
            //     'label' => 'Créateur de l\'événement',
            // ))
            ->add('eventPlace', EntityType::class, array(
                'class' => Place::class,
                'label' => 'Lieu de l\'événement',
            ))
            ->add('eventType')
            ->add('AppUserPerformer')
            ->add('EventTags')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
