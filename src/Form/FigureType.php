<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Figure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('nom', TextType::class,[
                'label' => false,
                'attr' => [
                    'class' => 'nomDesciption',
                ],
                ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'label' => false,
                'choice_label' => 'nom',
                 'attr' => [
        'class' => 'groupeDesciption',
    ],
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'createDesciption',
                ],
            ])


            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false, // Ne pas mapper cette propriété à l'entité
                'required' => false, // Rendre le champ facultatif
                'attr' => [
                    'accept' => 'image/*', // Filtre de type d'image
                    'multiple' => 'multiple', // Permet de sélectionner plusieurs fichiers
                ],
            ])
            ->add('videos', TextType::class, ['mapped' => false, 'label' => false,]);
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}
