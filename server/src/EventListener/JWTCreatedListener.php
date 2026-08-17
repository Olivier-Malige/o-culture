<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
// use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

/**
 * JWTCreatedListener
 *
 * @author Nicolas Cabot <n.cabot@lexik.fr>
 */
class JWTCreatedListener
{
    // /**
    //  * @param JWTCreatedEvent $event
    //  *
    //  * @return void
    //  */
    // public function onJWTCreated(JWTCreatedEvent $event)
    // {
    //     if (!($request = $event->getHeader())) {
    //         return;
    //     }

    //     $payload = $event->getData();
    //     $payload['ip'] = $request->getClientIp();

    //     $event->setData($payload);
    // }
    /**
     * @var RequestStack
     */
    private $requestStack;
    
    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    
    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        if (!$user instanceof \App\Entity\AppUser) {
            return;
        }
        $expiration = new \DateTime('+1 day');
        $expiration->setTime(2, 0, 0);

        $header = $event->getHeader();
        $header['cty'] = 'jwt';
        $payload = $event->getData();
        $payload['id'] = $user->getId();
        $payload['email'] = $user->getEmail();
        $payload['username'] = $user->getUsername();
        $payload['role'] = $user->getRole() ? $user->getRole()->getCode() : 'ROLE_USER';
        $payload['exp'] = $expiration->getTimestamp();
        $request = $this->requestStack->getCurrentRequest();
        $payload['ip'] = $request ? $request->getClientIp() : null;
        $event->setData($payload);
        $event->setHeader($header);
    
    }
}