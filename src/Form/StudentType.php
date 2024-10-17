<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Students;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType; // Correct import
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('name')
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Male' => 'M',
                    'Female' => 'F',
                ],
                'expanded' => true, // Pour afficher des boutons radio
                'multiple' => false, // Pour qu'une seule option soit sélectionnable
            ])
            ->add('birth_date', DateType::class, [ 
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd', // Ou un autre format de votre choix
            ])
            ->add('place_of_birth')
            ->add('parent_phone')
            ->add('adress')
            ->add('generale_average')
            ->add('class_id', EntityType::class, [
                'class' => Classes::class,
                'choice_label' => 'id',
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo',
                'mapped' => false,
                'required' => false,
            ])
            ->add("Save", SubmitType::class)
        ;
    } 

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Students::class,
        ]);
    }
}
