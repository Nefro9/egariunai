<?php

namespace App\Form\User\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class RoleType extends AbstractType
{
    private $roleHierarchy;

    public function __construct(RoleHierarchyInterface $roleHierarchy)
    {
        $this->roleHierarchy = $roleHierarchy;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = $this->getChoiceRoles();

        $resolver->setDefaults([
            'label'    => 'Role',
            'choices'  => $choices,
            'multiple' => FALSE,
            'constraints' => [
                new NotBlank(),
            ],
            'attr'        => [
                'placeholder' => 'Role'
            ]
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    private function getChoiceRoles()
    {
        $choice = [];

        $availableRoles = $this->roleHierarchy->getReachableRoles([new Role('ROLE_SUPER_ADMIN')]);

        foreach ($availableRoles as $availableRole) {
            $role = $availableRole->getRole();

            $choice[$role] = $role;
        }

        return $choice;
    }

}