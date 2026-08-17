<?php

namespace App\Controller\Api;

use App\Entity\EventType;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;

class EventTypeController extends BaseController
{
    /**
     * Lists all Event Types.
     * @Route("/api/eventtypes", methods={"GET"})
     */
    public function getEventTypes()
    {
        $eventTypes = $this->getDoctrine()->getRepository(EventType::class)->findAll();

        return $this->serializeJson($eventTypes, ['event_type_list']);
    }
}
