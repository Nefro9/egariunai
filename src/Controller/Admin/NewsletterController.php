<?php

namespace App\Controller\Admin;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/newsletter")
 */
class NewsletterController extends Controller
{
    /**
     * @Route("/", name="newsletter-list")
     */
    public function newsletterList()
    {
        $items = $this->getDoctrine()->getRepository(Newsletter::class)->findAll();

        return $this->render('admin/newsletter/newsletter-list.html.twig',[
            'items' => $items
        ]);
    }

    /**
     * @Route("/delete/{id}", name="newsletter-delete")
     * @param Newsletter $newsletter
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newsletterDelete(Newsletter $newsletter)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($newsletter);
        $em->flush();

        $this->addFlash('success', 'Newsletter successful deleted');

        return $this->redirectToRoute('newsletter-list');
    }

}