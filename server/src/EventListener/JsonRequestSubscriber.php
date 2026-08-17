<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Makes JSON request bodies readable via $request->get() after FOSRest removal.
 */
class JsonRequestSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => ['onRequest', 20]];
    }

    /**
     * Copy JSON body fields into the request bag so $request->get() keeps working.
     */
    public function onRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        $contentType = (string) $request->headers->get('Content-Type');
        if (stripos($contentType, 'application/json') === false) {
            return;
        }

        $data = json_decode($request->getContent(), true);
        if (is_array($data)) {
            $request->request->add($data);
        }
    }
}
