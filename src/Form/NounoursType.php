<?php

namespace App\Form;

use App\Entity\Nounours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NounoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la catégorie',
                'attr' => [
                    'placeholder' => 'Entrez le nom de la catégorie',
                    'class' => 'form-control',
                ],
            ])
            ->add('size' , TextType::class, [
                'label' => 'Taille',
                'attr' => [
                    'placeholder' => 'Entrez la taille',
                    'class' => 'form-control',
                ],
            ])
            ->add('price', TextType::class, [
                'label' => 'Prix',
                'attr' => [
                    'placeholder' => 'Entrez le prix',
                    'class' => 'form-control',
                ],
            ])
            ->add('publishAt')
            ->add('ispublished')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nounours::class,
        ]);
    }
}
