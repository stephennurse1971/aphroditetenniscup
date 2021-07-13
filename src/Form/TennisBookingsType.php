<?php

namespace App\Form;

use App\Entity\TennisBookings;
use App\Entity\TennisVenues;
use App\Entity\User;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TennisBookingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker datetime'
                ],
            ])
            ->add('cost')
            ->add('venue', EntityType::class,[
                'class'=> TennisVenues::class,
                'choice_label' => 'venue'
                ])
            ->add('player1',EntityType::class,[
                'class'=> User::class,
                'choice_label'=> 'fullName'
            ])
            ->add('player2',EntityType::class,[
                'class'=> User::class,
                'choice_label'=> 'fullName'
            ])
            ->add('player3',EntityType::class,[
                'class'=> User::class,
                'choice_label'=> 'fullName'
            ])
            ->add('player4',EntityType::class,[
                'class'=> User::class,
                'choice_label'=> 'fullName'
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TennisBookings::class,
        ]);
    }
}
