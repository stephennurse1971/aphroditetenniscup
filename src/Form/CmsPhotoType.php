<?php

namespace App\Form;

use App\Entity\CmsPhoto;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CmsPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Static' => 'Static',
                    'Product' => 'Product',
                ]
            ])
            ->add('staticPageName')
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'required' => true,
                'choice_label' => 'product'
            ])
            ->add('photoOrVideo', ChoiceType::class, [
                'multiple' => false,
                'expanded' => true,
                'choices' => [
                    'Photo' => 'Photo',
                    'Video' => 'Video',
                ],])
            ->add('photo', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Title (English)'
            ])
            ->add('link');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CmsPhoto::class,
            'allow_extra_fields' => true,
        ]);
    }
}
