<?php

namespace App\Controller\Api;

use App\Entity\Tag;
use App\Repository\TagRepository;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as FOSRest;


class TagController extends FOSRestController
{
    /**
     * Lists all Tags.
     * @FOSRest\Get("/api/tags")
     */

    public function getTags()
    {
        $repository = $this->getDoctrine()->getRepository(Tag::class);
       
        $tags = $repository->findall();
        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($tags, 'json', SerializationContext::create()->setGroups(array('tag_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        return $response;     
    }
    
}
