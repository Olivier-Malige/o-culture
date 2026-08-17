<?php

namespace App\Controller\Api;

use App\Entity\EventType;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $repository = $this->getDoctrine()->getRepository(EventType::class);

        $eventTypes = $repository->findall();
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($eventTypes, 'json', SerializationContext::create()->setGroups(array('event_type_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);


        return $response;
    }
}
