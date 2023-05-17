<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Figure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom'
            ])
            ->add('description', TextareaType::class)
            ->add('images', FileType::class, [
                'multiple' => true,
                'required' => false,
                'mapped' => false,
            ])
            ->add('videos', UrlType::class, [
                'required' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}
