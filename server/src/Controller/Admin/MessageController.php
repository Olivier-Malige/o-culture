<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chat/messages")
 */
class MessageController extends BaseController
{
    /**
     * @Route("/", name="message_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository): Response
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
       
        return $this->render('admin/message/index.html.twig', [
            'messagesSend' => $currentUser->getMessagesSend(),
            'messageReceived' => $currentUser->getMessagesReceived()
            ]);
    }

    /**
     * @Route("/new", name="message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message->setExpeditor($currentUser);
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('admin/message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="message_show", methods={"GET"})
     */
    public function show(Message $message): Response
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if(($message->getExpeditor()->getId() === $currentUser->getId()) || ($message->getReceiver()->getId() === $currentUser->getId()) ){

            return $this->render('admin/message/show.html.twig', ['message' => $message]);
        }
        else {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            return $reponse;
        }
    }

    // /**
    //  * @Route("/{id}/edit", name="message_edit", methods={"GET","POST"})
    //  */
    // public function edit(Request $request, Message $message): Response
    // {
    //     $form = $this->createForm(MessageType::class, $message);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('message_edit', ['id' => $message->getId()]);
    //     }

    //     return $this->render('admin/message/edit.html.twig', [
    //         'message' => $message,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="message_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Message $message): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($message);
    //         $em->flush();
    //     }

    //     return $this->redirectToRoute('message_index');
    // }
}
