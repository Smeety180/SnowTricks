<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Notifier\Texter;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Figure;


class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Écrivez votre commentaire ici...',
                ],
            ])


            /*
                        ->add('dateMsg', DateTimeType::class, [
                            'label' => 'Date du commentaire',
                        ])
                        ->add('user', EntityType::class, [
                            'class' => User::class,
                            'choice_label' => 'pseudo', // Remplacez 'username' par la propriété de l'utilisateur que vous souhaitez afficher
                        ])
                        ->add('figure', EntityType::class, [
                            'class' => Figure::class,
                            'choice_label' => 'nom', // Remplacez 'name' par la propriété de Figure que vous souhaitez afficher
                        ])*/
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
