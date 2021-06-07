<?php

namespace App\Form;

use App\Entity\TennisPlayerAvailability;
use App\Entity\TennisPlayers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TennisPlayerAvailabilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tennisPlayer', EntityType::class,[
                'class'=> TennisPlayers::class,
                'choice_label'=> 'name'
            ])
            ->add('date', DateTimeType::class, [
                'label' => "Date",
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datetimepicker datetime'
                ],
            ])
            ->add('hour')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TennisPlayerAvailability::class,
        ]);
    }
}
