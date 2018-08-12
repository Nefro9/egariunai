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

        $menu = $factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'             => 'nav nav-pills flex-column',
            ),
        ));

        $menu->addChild('Pagrindinis', array(
            'route' => 'admin',
            'attributes'    => array(
                'icon' => 'fa fa-home'
            )
        ));

        $menu->addChild('Prekės', array(
            'route' => 'products',
            'attributes'    => array(
                'icon' => 'fa fa-list'
            )
        ));

        $menu->addChild('Užsakymai', array(
            'route' => 'orders',
            'attributes'    => array(
                'icon' => 'fa fa-cart-plus'
            )
        ));

        $menu->addChild('Kategorijos', array(
            'route' => 'categories',
            'attributes'    => array(
                'icon' => 'fa fa-tags'
            )
        ));

        $menu->addChild('Vartotojai', array(
            'route' => 'users',
            'attributes'    => array(
                'icon' => 'fa fa-users'
            )
        ));

        $menu->addChild('Žinutės', array(
            'route' => 'messages',
            'attributes'    => array(
                'icon' => 'fa fa-envelope'
            )
        ));

        $menu->addChild('menu-space', array(
            'label' => '',
            'attributes'    => array(
                'class' => 'mt-3'
            )
        ));

        $menu->addChild('Logout', array(
            'route' => 'fos_user_security_logout',
            'attributes'    => array(
                'icon' => 'fa fa-sign-out'
            )
        ));






        return $menu;
    }
}