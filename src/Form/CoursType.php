<?php

namespace App\Form;
 
use App\Entity\Cours;
use App\Entity\Classes; // Importer l'entité Classes
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du cours',
                'attr' => [
                    'placeholder' => 'Ex: Mathématiques',
                ],
            ])
            ->add('teacher', TextType::class,[
                'required' => false
            ])

            ->add('classe', EntityType::class, [ // Champ pour choisir la classe
                'class' => Classes::class,
                'choice_label' => 'name', // Afficher le nom de la classe
                'label' => 'Classe',

            ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}