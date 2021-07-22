<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('pitch')
            ->add('description')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'download_uri' => true,
                'image_uri' => true,
                'label' => false,
                'allow_delete' => false,
            ])
            ->add('updatedAt')
            ->add('githubLink')
            ->add('websiteLink')
            ->add('createdAt')
            ->add('technos'/* , CollectionType::class, [
                'entry_type' => TechnosType::class,
                'entry_options' => ['label' => false],
                'allow_add' => false,
            ] */);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
