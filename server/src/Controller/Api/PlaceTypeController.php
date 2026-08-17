<?php

namespace App\Controller\Api;

use App\Entity\PlaceType;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;


class PlaceTypeController extends BaseController
{
    /**
    * Lists all Place Types.
    * @Route("/api/placetypes", methods={"GET"})
    */
    public function getPlaceTypes()
    {
        $repository = $this->getDoctrine()->getRepository(PlaceType::class);

        $placeTypes = $repository->findall();
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($placeTypes, 'json', SerializationContext::create()->setGroups(array('place_type_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        return $response;
    }
}
