<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Les prdoduits")
            ->setEntityLabelInSingular("un produit")
            ->setPaginatorPageSize(15);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Le nom du Produit'),
            SlugField::new('slug')->setTargetFieldName('name')->onlyOnForms(),
            IntegerField::new('price', 'Le prix'),
            AssociationField::new('category', 'Le categorie'),
            ImageField::new('image', 'L\'image du produit')
                ->setBasePath('assets/uploads/')
                ->setUploadDir('public/assets/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextEditorField::new('description', 'La description'),
            BooleanField::new('isInStok', 'Disponible')->hideOnForm(),
        ];
    }
}
