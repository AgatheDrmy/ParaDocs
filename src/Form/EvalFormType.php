<?php

namespace App\Form;

use App\Entity\difficulte;
use App\Entity\Evaluation;
use App\Entity\question;
use App\Entity\theme;
use App\Entity\utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('is_calculatrice')
            ->add('is_ordinateur')
            ->add('is_document')
            ->add('autre_modalite')
            ->add('introduction')
            ->add('date_heure', null, [
                'widget' => 'single_text',
            ])
            // ->add('date_creation', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('duree', null, [
                'widget' => 'single_text',
            ])
            // ->add('is_active')
            ->add('theme_eval', EntityType::class, [
                'class' => theme::class,
                'choice_label' => 'id',
            ])
            ->add('difficulte_eval', EntityType::class, [
                'class' => difficulte::class,
                'choice_label' => 'id',
            ])
            // ->add('evaluation_utilisateur', EntityType::class, [
            //     'class' => utilisateur::class,
            //     'choice_label' => 'id',
            // ])
            ->add('question_evaluation', EntityType::class, [
                'class' => question::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
