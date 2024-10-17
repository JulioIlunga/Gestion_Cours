<?php

namespace App\Form;

use App\Entity\Classes;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la classe',
                'attr' => [
                    'placeholder' => 'Ex: Sixième A',
                ],
            ])
            ->add('level' , ChoiceType::class, [
                'label' => 'Niveau',

                'choices'  => [
                    'Maternelle' => 'Maternelle',
                    'Primaire' => 'Primaire',
                    'humanités' => 'humanités',
                ],
                'expanded' => true, // Pour afficher des boutons radio
                'multiple' => false, // Pour qu'une seule option soit sélectionnable
            ])
            ->add('section', TextType::class, [
                'label' => 'Section',
                'attr' => [
                    'placeholder' => 'Ex: scientifique (pour level humanités)',
                ],
                'required' => false,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}