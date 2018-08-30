<?php

namespace App\Controller\Admin;

use App\Form\User\EditUserForm;
use App\Entity\User;
use App\Form\User\CreateUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userAdd(Request $request)
    {
        $user = new User();

        $form = $this->createForm(CreateUserForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                             ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'New user successful created');

            return $this->redirectToRoute('user-edit', ['user' => $user->getId()]);
        }

        return $this->render('admin/user/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{user}", name="user-edit")
     *
     * @param Request $request
     *
     * @param User $user
     */
    public function userEdit(Request $request, User $user)
    {
        $form = $this->createForm(EditUserForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($user->getPlainPassword()) {
                $password = $this->get('security.password_encoder')
                                 ->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'User successful created');

            return $this->redirectToRoute('user-edit', ['user' => $user->getId()]);
        }


        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'item' => $user
        ]);
    }

    /**
     * @Route("/delete/{user}", name="user-delete")
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