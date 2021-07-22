<?php

namespace App\Controller\Admin;

use App\Entity\AboutMe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AboutMeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AboutMe::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            ImageField::new('avatar')->setUploadDir('public/images/')->onlyOnForms(),
            TextField::new('title'),
            TextField::new('email'),
            TextField::new('githubLink'),
            TextField::new('function'),
            TextareaField::new('description'),
        ];

        /* if ($pageName == Crud::PAGE_EDIT) {
            $image = ImageField::new('imageLink', 'Image')->setBasePath('images/');
            array_push($fields, $image);
        } */

        return $fields;
    }
    
}
