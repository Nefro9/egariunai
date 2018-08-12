<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\RegistrationForm;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/u")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_form")
     */
    public function login(Request $request, AuthenticationUtils  $authenticationUtils): Response
    {
        $form = $this->createForm(LoginForm::class);

        $error = $authenticationUtils->getLastAuthenticationError();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $error = $authenticationUtils->getLastAuthenticationError();
                dump($error);

//            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
//            $user->setPassword($password);
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//
//            return $this->redirectToRoute('login_form');
        }

        return $this->render(
            'security/login.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/register",  name="register_form")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('register_form');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/profile",  name="profile")
     */
    public function profile(): Response
    {
        return $this->render(
            'profile.html.twig'
        );
    }
}
