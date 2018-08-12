<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            UserRegistrationEvent::NAME => 'onRegistrationComplete',
        ];
    }


    public function onRegistrationComplete(UserRegistrationEvent $event)
    {
        //TODO: send email
        $this->session->getFlashBag()->add('success', 'Sveikiname, jus sekmingai užsiregistravote');
    }


}
