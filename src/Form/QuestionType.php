<?php
// src/Form/QuestionType.php

namespace App\Form;

use App\Entity\Evaluations;
use App\Entity\Questions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class QuestionType extends AbstractType
{ 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('evaluations', EntityType::class, [
                'class' => Evaluations::class,
                'label' => 'Evaluation',
                'choice_label' => 'nomEvaluation',
                'data' => $options['evaluation'], // Pré-sélectionner l'évaluation
                'disabled' => true,
            ])
            ->add('enonce_question')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Question à réponse libre' => 'texte',
                    'Question à choix multiples' => 'choix_multiple',
                ],
                'attr' => [
                    'placeholder' => 'Saisissez l’énoncé de la question',
                ],
            ])
            
            ->add('assertions', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => ['label' => 'Assertion'],
                'allow_add' => true, // Permet l'ajout dynamique
                'allow_delete' => true, // Permet la suppression dynamique
                'label' => "Assertions",
                'required' => false,
                'attr' => ['class' => 'assertions-field'], // Classe pour ciblage JS
            ])


            ->add('Enregistrer', SubmitType::class)
        ;
        
        
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
            'evaluation' => null,
        ]);
    }
}