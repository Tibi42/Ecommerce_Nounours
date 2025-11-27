<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('designation', TextareaType::class, [
                'label' => 'Designation',
                'attr' => [
                    'placeholder' => 'Entrez la designation',
                    'class' => 'form-control',
                ],
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'attr' => [
                    'placeholder' => 'Entrez le slug',
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Entrez la description',
                    'class' => 'form-control',
                ],
            ])
            ->add('icon', TextType::class, [
                'label' => 'Icon',
                'attr' => [
                    'placeholder' => 'Entrez l\'icon',
                    'class' => 'form-control',
                ],
            ])
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date de creation',
                'attr' => [
                    'placeholder' => 'Entrez la date de creation',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
