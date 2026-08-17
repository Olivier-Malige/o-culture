<?php

namespace App\EventListener;

use App\Entity\AppUser;
use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

/**
 * Adds profile fields used by the SPA to the JWT payload.
 */
class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();
        if (!$user instanceof AppUser) {
            return;
        }

        $expiration = new DateTime('+1 day');
        $expiration->setTime(2, 0, 0);

        $header = $event->getHeader();
        $header['cty'] = 'jwt';

        $payload = $event->getData();
        $payload['id'] = $user->getId();
        $payload['email'] = $user->getEmail();
        $payload['username'] = $user->getUsername();
        $payload['role'] = $user->getRole() ? $user->getRole()->getCode() : 'ROLE_USER';
        $payload['exp'] = $expiration->getTimestamp();

        $event->setData($payload);
        $event->setHeader($header);
    }
}
