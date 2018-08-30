<?php

namespace App\Form\User;

use App\Form\User\Type\RoleType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserForm extends UserForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('roles', RoleType::class)
        ;

        $builder->get('roles')
                ->addModelTransformer(new CallbackTransformer(
                    function($roles) {
                        return $roles[0];
                    },
                    function($role) {
                        return [$role];
                    }
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\User',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'user';
    }
}