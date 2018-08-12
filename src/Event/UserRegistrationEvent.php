<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegistrationEvent extends Event
{
    const ON_COMPLETE = 'registration.on_complete';
    const AUTO_LOGGIN = 'registration.auto_loggin';

    /**
     * @var User $user
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}