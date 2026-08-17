<?php

namespace App\Controller\Api;

use App\Entity\PlaceType;
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
        $placeTypes = $this->getDoctrine()->getRepository(PlaceType::class)->findAll();

        return $this->serializeJson($placeTypes, ['place_type_list']);
    }
}
