<?php

namespace App\Controller\Api;

use App\Entity\Tag;
use App\Repository\TagRepository;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;


class TagController extends BaseController
{
    /**
     * Lists all Tags.
     * @Route("/api/tags", methods={"GET"})
     */

    public function getTags()
    {
        $repository = $this->getDoctrine()->getRepository(Tag::class);
       
        $tags = $repository->findall();
        $serializer = $this->container->get('jms_serializer');
        $jsonContent = $serializer->serialize($tags, 'json', SerializationContext::create()->setGroups(array('tag_list')));
        $response = new Response($jsonContent, Response::HTTP_OK);

        return $response;     
    }
    
}
