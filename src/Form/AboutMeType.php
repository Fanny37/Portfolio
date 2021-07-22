<?php

namespace App\Form;

use App\Entity\AboutMe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AboutMeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('email')
            ->add('githubLink')
            ->add('function')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'download_uri' => true,
                'image_uri' => true,
                'label' => false,
                'allow_delete' => false,
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AboutMe::class,
        ]);
    }
}
