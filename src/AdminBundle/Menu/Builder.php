<?php

namespace App\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'nav nav-pills flex-column',
            ],
        ]);

        $menu->addChild('Pagrindinis', [
            'route'      => 'admin',
            'attributes' => [
                'icon' => 'fa fa-home'
            ]
        ]);

        $menu->addChild('Prekės', [
            'route'      => 'products',
            'attributes' => [
                'icon' => 'fa fa-list'
            ]
        ]);

        $menu->addChild('Užsakymai', [
            'route'      => 'orders',
            'attributes' => [
                'icon' => 'fa fa-cart-plus'
            ]
        ]);

        $menu->addChild('Kategorijos', [
            'route'      => 'categories',
            'attributes' => [
                'icon' => 'fa fa-tags'
            ]
        ]);

        $menu->addChild('Vartotojai', [
            'route'      => 'users',
            'attributes' => [
                'icon' => 'fa fa-users'
            ]
        ]);

        $menu->addChild('Žinutės', [
            'route'      => 'messages',
            'attributes' => [
                'icon' => 'fa fa-envelope'
            ]
        ]);

        $menu->addChild('menu-space', [
            'label'      => '',
            'attributes' => [
                'class' => 'mt-3'
            ]
        ]);

        $menu->addChild('Logout', [
            'route'      => 'fos_user_security_logout',
            'attributes' => [
                'icon' => 'fa fa-sign-out'
            ]
        ]);


        return $menu;
    }
}