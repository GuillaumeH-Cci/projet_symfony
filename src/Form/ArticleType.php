<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categories;
use App\Entity\Plateforme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('article_name', TextType::class, [
                'label' => 'Titre du jeu',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('article_desc', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
                'attr' => ['class' => 'form-control', 'rows' => 5],
            ])
            ->add('article_thumbnail', TextType::class, [
                'label' => 'URL de la jaquette / image',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('article_nbr_player', IntegerType::class, [
                'label' => 'Nombre de joueurs',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('cat', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'catName',
                'label' => 'Catégorie',
                'placeholder' => 'Choisir une catégorie',
                'required' => true,
                'attr' => ['class' => 'form-select'],
            ])
            ->add('plat', EntityType::class, [
                'class' => Plateforme::class,
                'choice_label' => 'platName',
                'label' => 'Plateformes',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'attr' => ['class' => 'form-select'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter le jeu',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'csrf_protection' => true,
        ]);
    }
}
