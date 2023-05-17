<?php

namespace App\Controller\Admin;

use App\Entity\Figure;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class FigureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Figure::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);

        // Ajouter l'action de suppression seulement pour les utilisateurs avec le rôle "ROLE_ADMIN"

            $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
            $actions->add(Crud::PAGE_INDEX, Action::DELETE);


        // Autoriser la modification pour tous les utilisateurs
        $actions->add(Crud::PAGE_INDEX, Action::EDIT);

        // Autoriser l'ajout pour tous les utilisateurs
        $actions->add(Crud::PAGE_INDEX, Action::NEW);

        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextEditorField::new('description'),
            ImageField::new('images'),
            TextField::new('videos'),
            TextField::new('slug')->hideOnForm(),
        ];
    }
}
