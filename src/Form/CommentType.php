<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('authorName', TextType::class, [
                'label' => 'Nom de l\'auteur',
                'attr' => [
                    'placeholder' => 'Entrez le nom de l\'auteur',
                    'class' => 'form-control',
                ],
            ])
            ->add('authorEmail', EmailType::class, [
                'label' => 'Email de l\'auteur',
                'attr' => [
                    'placeholder' => 'Entrez l\'email de l\'auteur',
                    'class' => 'form-control',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu du commentaire',
                'attr' => [
                    'placeholder' => 'Entrez le contenu du commentaire',
                    'class' => 'form-control',
                    'rows' => 5,
                ],
            ])
            ->add('ipAddress', TextType::class, [
                'label' => 'IP de l\'auteur',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez l\'IP de l\'auteur (optionnel)',
                    'class' => 'form-control',
                ],
            ])
            ->add('isApproved', CheckboxType::class, [
                'label' => 'Approuvé',
                'required' => false,
            ])
            ->add('createAt', DateTimeType::class, [
                'label' => 'Date de création',
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de création (optionnel)',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
