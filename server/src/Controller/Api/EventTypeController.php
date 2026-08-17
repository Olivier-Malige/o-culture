<?php

namespace App\Controller\Api;

use App\Entity\EventType;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as FOSRest;


class EventTypeController extends FOSRestController
{
    /**
    * Lists all Event Types.
    * @FOSREst\Get("/api/eventtypes")
    */
    public function getEventTypes()
    {
        $repository = $this->getDoctrine()->getRepository(EventType::class);

        $eventTypes = $repository->findall();
        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($eventTypes, 'json', SerializationContext::create()->setGroups(array('event_type_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);


        return $response;
    }
}
