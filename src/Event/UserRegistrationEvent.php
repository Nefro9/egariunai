<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegistrationEvent extends Event
{
    const REGISTRATION_SUCCESS = 'registration.success';

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