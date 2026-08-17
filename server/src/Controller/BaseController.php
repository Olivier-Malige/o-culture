<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Shared controller helpers for Doctrine access and JMS JSON output.
 */
abstract class BaseController extends AbstractController
{
    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            'doctrine' => '?'.ManagerRegistry::class,
            'jms_serializer' => '?'.SerializerInterface::class,
        ]);
    }

    protected function getDoctrine(): ManagerRegistry
    {
        return $this->container->get('doctrine');
    }

    /**
     * Serialize data with JMS groups so unannotated fields (e.g. password) stay hidden.
     */
    protected function serializeJson($data, array $groups = []): Response
    {
        $context = SerializationContext::create()->setSerializeNull(true);
        if ($groups !== []) {
            $context->setGroups($groups);
        }

        $json = $this->container->get('jms_serializer')->serialize($data, 'json', $context);

        return new Response($json, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
