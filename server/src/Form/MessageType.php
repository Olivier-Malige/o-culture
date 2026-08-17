<?php

namespace App\Form;

use App\Entity\AppUser;
use App\Entity\Message;
use App\Repository\AppUserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $builder
            ->add('content')
            // ->add('createdAt')
          

                ->add('receiver', EntityType::class, array(
                    'class' => AppUser::class,
                    'query_builder' => function (AppUserRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->orderBy('u.username', 'ASC')
                            ->where('u.status = 2')
                            ->orWhere('u.status = 3');
                    },
                    'choice_label' =>'username',
                ));
            }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
