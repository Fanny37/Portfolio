<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
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
            ImageField::new('illustration')->setUploadDir('public/images/')->onlyOnForms(),
            TextField::new('title'),
            TextareaField::new('pitch'),
            TextareaField::new('description'),
            TextField::new('githubLink'),
            TextField::new('websiteLink'),
            DateField::new('createdAt'),
            /* CollectionField::new('technos')->setFormTypeOptions([
                'delete_empty' => true,
                'by_reference' => false,
            ])->setCustomOptions([
                'entryType' => 'App\Form\TechnosType',
                'showEntryLabel' => false,
            ]), */
        ];

        return $fields;
    }
    
}
