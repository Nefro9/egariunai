<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity111\ProductCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\AdminBundle\Form\DataTransformer\ParentCategoryTransformer;

class NewCategory extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('parent', EntityType::class, [
                'placeholder'  => 'Select parent',
                'required'     => FALSE,
                'class'        => ProductCategory::class,
                'choice_label' => 'title',
            ]);;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductCategory::class,
        ]);
    }
}