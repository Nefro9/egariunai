<?php

namespace App\Form\User;

use App\Form\User\Type\RoleType;
use App\Form\User\UserForm;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateUserForm extends UserForm
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type'            => PasswordType::class,
                'first_options'   => ['label' => 'Slaptažodis'],
                'second_options'  => ['label' => 'Pakartoti slaptažodį'],
                'invalid_message' => 'Slaptažodžio turi sutapti',
            ])
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