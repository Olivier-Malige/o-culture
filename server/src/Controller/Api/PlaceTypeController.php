<?php

namespace App\Controller\Api;

use App\Entity\PlaceType;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as FOSRest;


class PlaceTypeController extends FOSRestController
{
    /**
    * Lists all Place Types.
    * @FOSREst\Get("/api/placetypes")
    */
    public function getPlaceTypes()
    {
        $repository = $this->getDoctrine()->getRepository(PlaceType::class);

        $placeTypes = $repository->findall();
        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($placeTypes, 'json', SerializationContext::create()->setGroups(array('place_type_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        return $response;
    }
}
