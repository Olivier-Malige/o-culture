<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;
/**
 * JWTDecodedListener
 *
 * @author Nicolas Cabot <n.cabot@lexik.fr>
 */
class JWTDecodedListener
{
// /**
//      * @param JWTDecodedEvent $event
//      *
//      * @return void
//      */
//     public function onJWTDecoded(JWTDecodedEvent $event)
//     {
//         if (!($request = $event->getHeader())) {
//             return;
//         }
//         $payload = $event->getPayload();
//         $request = $event->getRequest();
//         if (!isset($payload['ip']) || $payload['ip'] !== $request->getClientIp()) {
//             $event->markAsInvalid();
//         }
//     }
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
      * 
      * @param JWTDecodedEvent $event
      *
      * @return void
      */
     
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        // Do not pin tokens to the client IP: behind Caddy/Docker,
        // X-Forwarded-For and IPv4/IPv6 make this check reject valid sessions.
    }
}


