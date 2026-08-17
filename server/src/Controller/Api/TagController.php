<?php

namespace App\Controller\Api;

use App\Entity\Tag;
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
        $tags = $this->getDoctrine()->getRepository(Tag::class)->findAll();

        return $this->serializeJson($tags, ['tag_list']);
    }
}
