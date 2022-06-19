<?php

namespace App\Controller\Admin;

use App\Entity\Publicity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PublicityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Publicity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', "Nom de la Pub"),
            ImageField::new('image', 'Image')
                ->setBasePath('assets/uploads/')
                ->setUploadDir('public/assets/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextEditorField::new('description')
        ];
    }
}
