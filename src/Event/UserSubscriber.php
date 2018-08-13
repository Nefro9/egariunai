<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserSubscriber implements EventSubscriberInterface
{
    private $session;
    private $tokenStorage;

    public function __construct(SessionInterface $session, TokenStorageInterface $tokenStorage)
    {
        $this->session      = $session;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            UserRegistrationEvent::AUTO_LOGGIN => 'autoLogginUser',
            UserRegistrationEvent::ON_COMPLETE => 'onRegistrationComplete',
        ];
    }

    public function onRegistrationComplete(UserRegistrationEvent $event)
    {
        //TODO: send email
        $user = $event->getUser();

        $this->session->getFlashBag()->add('success', 'Sveikiname ' . $user->getUsername() . ', jus sekmingai užsiregistravote');
    }

    public function autoLogginUser(UserRegistrationEvent $event)
    {
        $user = $event->getUser();

        $token = new UsernamePasswordToken($user, NULL, 'main', $user->getRoles());
        $this->tokenStorage->setToken($token);
        $this->session->set('_security_main', serialize($token));
    }
}
