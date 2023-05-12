<?php

namespace App\Controller\Admin;

use App\Entity\Figure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FigureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Figure::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            TextField::new('nom'),
            TextEditorField::new('description'),
            ImageField::new('images')->hideOnForm(),
            TextField::new('videos')->hideOnForm(),
            TextField::new('slug')->hideOnForm(),
        ];
    }


}
