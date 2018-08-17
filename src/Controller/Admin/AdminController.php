<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{

    /**
     * @Route("/", name="dashboard")
     */
    public function dashboard()
    {

        return $this->render('admin/dashboard.html.twig');
    }

}