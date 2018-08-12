<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/")
 */
class WebsiteController extends AbstractController
{
    /**
     * @Route("/",  methods={"GET"}, name="homepage")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
