<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Difficulte;
use App\Entity\Question;
use App\Entity\Type;
use App\Entity\Utilisateur;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddQuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enonce',  TextareaType::class, ['constraints' => [new NotBlank]])
            ->add('image')
            // ->add('is_active')
            ->add('type_question', EntityType::class, [
                'class' => type::class,
                'choice_label' => 'id',
                'constraints' => [new NotBlank],
            ])
            ->add('difficulte', EntityType::class, [
                'class' => Difficulte::class,
                'choice_label' => 'id',
                'constraints' => [new NotBlank],
            ])
            // ->add('question_utilisateur', EntityType::class, [
            //     'class' => utilisateur::class,
            //     'choice_label' => 'id',
            //     'constraints' => [new NotBlank],
            // ])
            ->add('chapitre', EntityType::class, [
                'class' => Chapitre::class,
                'choice_label' => 'id',
                'constraints' => [new NotBlank],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
