<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\Event;
use App\Entity\AppUser;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/", name="event_index_all", methods="GET")
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('admin/event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    /**
     * @Route("/page/{page}", name="event_index", methods="GET")
     * @param integer $page
     */
    public function indexAdmin($page)
    {
        
        $eventRepository = $this->getDoctrine()->getRepository(Event::class);
        $events = $eventRepository->getAllAdminEvents($page);
        $totalEvents = $events->count();
        $iterator = $events->getIterator();
        $maxPages = ceil($totalEvents / 10);
        $thisPage = $page;
        
        return $this->render('admin/event/index.html.twig', ['events' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="event_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $event = new Event();

        $repositoryRole = $this->getDoctrine()->getRepository(Role::class);
        $role = $repositoryRole->findOneBy(['code' => 'ROLE_ADMINISTRATOR']);
                
        $repositoryUser = $this->getDoctrine()->getRepository(AppUser::class);
        $user = $repositoryUser->findOneBy(['role' => $role]);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $comment->setAppUserCreator($user);
            $em->persist($event);
            $em->flush();

            $this->addFlash(
                'notice',
                'L\'évenement a bien été ajouté !'
            );

            return $this->redirectToRoute('event_index');
        }

        return $this->render('admin/event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods="GET")
     */
    public function show(Event $event): Response
    {
        // dump($event);die;
        return $this->render('admin/event/show.html.twig', ['event' => $event]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods="GET|POST")
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'L\'évenement a bien été modifié !'
            );
            return $this->redirectToRoute('event_index_all');
        }

        return $this->render('admin/event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods="DELETE")
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
            $this->addFlash(
                'notice',
                'L\'évenement a bien été supprimé !'
            );
        }

        return $this->redirectToRoute('event_index_all');
    }
}
