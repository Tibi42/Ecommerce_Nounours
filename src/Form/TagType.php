<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du tag',
                'attr' => [
                    'placeholder' => 'Entrez le nom du tag',
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
            ->add('color', TextType::class, [
                'label' => 'Couleur',
                'attr' => [
                    'placeholder' => 'Entrez la couleur',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
