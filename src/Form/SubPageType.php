<?php

namespace App\Form;

use App\Entity\ContentPage;
use App\Entity\SubPage;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class,[
                'class'=> Product::class,
                'required'=>true,
                'choice_label'=>'product'
            ])
            ->add('title')
            ->add('content')
            ->add('image')
            ->add('rank')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubPage::class,
        ]);
    }
}
