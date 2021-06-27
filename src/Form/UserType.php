<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('fullName')
            ->add('email')
            ->add('email2')
            ->add('mobile')
            ->add('mobile2')
            ->add('role',ChoiceType::class,[
                'multiple'=>true,
                'expanded'=>true,
                'choices'=>[
                    'Super-Admin'=>'ROLE_SUPER_ADMIN',
                    'Admin'=>'ROLE_ADMIN',
                    'Tennis player'=>'ROLE_TENNIS_PLAYER',
                    'Family'=>'ROLE_FAMILY',
                ],
                'mapped'=>false
            ])
            ->add('password',PasswordType::class,[
                'mapped'=>false,
            ])

            ->add('sendEmail',HiddenType::class,[
                'mapped' => false,
                'required'=>false
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
