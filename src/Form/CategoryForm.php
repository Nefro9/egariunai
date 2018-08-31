<?php

namespace App\Form;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryForm extends AbstractType
{
    private $entityId;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($builder->getData()) {
            $this->entityId = $builder->getData()->getId();
        }

        //TODO: Fix orders
        $builder
            ->add('title')
            ->add('order')
            ->add('parent', EntityType::class, [
                'placeholder'   => 'Select parent',
                'required'      => FALSE,
                'class'         => Category::class,
                'query_builder' => function(CategoryRepository $er) {
                    $qr = $er->createQueryBuilder('c');

                    if ($this->entityId) {
                        $qr->andWhere('c.id != :current')
                           ->setParameter('current', $this->entityId);
                    }

                    return $qr;
                },
                'choice_label'  => function(Category $category) {
                    if($category->getParent()) {
                        return sprintf('%s --> %s', $category->getParent()->getTitle(), $category->getTitle());
                    } else {
                        return $category->getTitle();
                    }
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}