<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Slapyvardis'
            ])
//            ->add('firstName', TextType::class, [
//                'label'    => 'Vardas',
//                'required' => FALSE
//            ])
//            ->add('lastName', TextType::class, [
//                'label'    => 'Pavardė',
//                'required' => FALSE
//            ])
            ->add('email', TextType::class, [
                'label' => 'El. Paštas'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'            => PasswordType::class,
                'first_options'   => ['label' => 'Slaptažodis'],
                'second_options'  => ['label' => 'Pakartoti slaptažodį'],
                'invalid_message' => 'Slaptažodžio turi sutapti',
                'required'        => FALSE
            ]);
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