<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user-list")
     */
    public function userList()
    {
        $items = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/user/list.html.twig', [
            'items' => $items
        ]);
    }

    /**
     * @Route("/add", name="user-add")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function userAdd()
    {
        $this->addFlash('success', 'User successful create');

        return $this->redirectToRoute('user-list');
    }

    /**
     * @Route("/delete/{id}", name="user-delete")
     * @param User $user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function userDelete(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'User successful deleted');

        return $this->redirectToRoute('user-list');
    }

}