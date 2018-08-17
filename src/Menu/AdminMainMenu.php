<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

class AdminMainMenu
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function adminMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Main',[
            'extras' => ['title' => true]
        ]);

        $menu->addChild('Dashboard', [
            'route' => 'dashboard',
            'extras' => [
                'icon' => 'home',
                'icon_type' => 'material',
            ]
        ]);

        $menu->addChild('Users', [
            'route' => 'homepage',
            'extras' => [
                'icon' => 'folder_open',
                'icon_type' => 'material',
            ]
        ]);

        $menu['Users']->addChild('List users', [
            'route'      => 'dashboard'
        ]);

        return $menu;
    }
}