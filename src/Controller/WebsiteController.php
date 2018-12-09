<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Newsletter;
use App\Form\NewsletterForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @Route("/",  methods={"GET", "POST"}, name="homepage")
     * @param Request $request
     *
     * @param SessionInterface $session
     *
     * @return Response
     */
    public function index(Request $request, SessionInterface $session): Response
    {
        $newsletter = new Newsletter;
        $form       = $this->createForm(NewsletterForm::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newsletter->setIpAddress($request->getClientIp());

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $session->set('newsletter', 'done');
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAllOrder();

        return $this->render('index.html.twig', [
            'newsletter'      => $form->createView(),
            'categories'      => $categories,
            'currentCategory' => NULL
        ]);
    }

    /**
     * @Route("/category/{category_slug}",  methods={"GET", "POST"}, name="category_list")
     * @param Request $request
     *
     * @param SessionInterface $session
     *
     * @param Category $category_slug
     *
     * @return Response
     */
    public function category(Request $request, SessionInterface $session, $category_slug): Response
    {
        $currentCategory = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['slug' => $category_slug]);

        $newsletter = new Newsletter;
        $form       = $this->createForm(NewsletterForm::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newsletter->setIpAddress($request->getClientIp());

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $session->set('newsletter', 'done');
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAllOrder();

        return $this->render('index.html.twig', [
            'newsletter'      => $form->createView(),
            'categories'      => $categories,
            'currentCategory' => $currentCategory
        ]);
    }
}
