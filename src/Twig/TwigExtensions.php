<?php

namespace App\Twig;

class TwigExtensions extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('unset', [$this, 'unsetArrayItem']),
        ];
    }

    public function unsetArrayItem($array, $unsetItem)
    {
        if (isset($array[$unsetItem])) {
            unset($array[$unsetItem]);
        }
        return $array;
    }
}