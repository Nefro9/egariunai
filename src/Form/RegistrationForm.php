<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'       => 'El. paštas',
                'attr' => [
                    'placeholder' => 'abc@gmail.com',
                ]
            ])
            ->add('username', TextType::class, [
                'label'       => 'Slapyvardis',
                'attr' => [
                    'placeholder' => 'tomas_k',
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label'       => 'Slaptažodis',
                'attr' => [
                    'placeholder' => 'A-z, 0-9',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }
}