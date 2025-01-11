<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Cours;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Evaluations;
use App\Entity\Questions;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom_evaluation', TextType::class, [
            'label' => "Nom de l'evaluation",
            'attr' => [
                'placeholder' => 'Ex: Interro chimie 6ième B',
            ],
        ])
        ->add('classe', EntityType::class, [
            'class' => Classes::class,
            'data' => $options['classe'],
            'choice_label' => 'name',
            'label' => 'Classe',
            'multiple' => false,
            'expanded' => false,
            'placeholder' => 'Sélctionner une  classe'
            
        ])
        ->add('cours', EntityType::class, [
            'class' => Cours::class,
            'choices' => $options['cours'],
            'choice_label' => 'title',
            'multiple' => false,
        ])
            ->add('start_at', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('end_at', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            
            ->add('evaluation_type', ChoiceType::class, [
                'choices'  => [
                    'Devoir' => 'Devoir',
                    'Interrogation' => 'Interrogation',
                    'Examen' => 'Examen'],
                    'expanded' => true, // Pour afficher des boutons radio
                    'multiple' => false,  

                
            ])
            // ->add('question_id', EntityType::class, [
            //     'required' => false,
            //     'class' => Questions::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add('max_points')
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluations::class,
            'cours' => [],
            'classe' => null,
        ]);
    }
}
