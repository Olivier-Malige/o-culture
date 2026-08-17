<?php

namespace App\Controller\Admin;

use App\Entity\EventType;
use App\Form\EventSortType;
use App\Repository\EventTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/eventtype")
 */
class EventTypeController extends Controller
{
    /**
     * @Route("/", name="event_type_index_all", methods="GET")
     */
    public function index(EventTypeRepository $eventTypeRepository): Response
    {
        return $this->render('admin/event_type/index.html.twig', ['event_types' => $eventTypeRepository->findAll()]);
    }

    /**
     * @Route("/page/{page}", name="event_type_index", methods="GET")
     * @param integer $page
     */
    public function indexAdmin($page)
    {
        
        $eventTypeRepository = $this->getDoctrine()->getRepository(EventType::class);
        $eventTypes = $eventTypeRepository->getAllAdminEventTypes($page);
        $totalEventTypes = $eventTypes->count();
        $iterator = $eventTypes->getIterator();
        $maxPages = ceil($totalEventTypes / 10);
        $thisPage = $page;
        
        return $this->render('admin/event_type/index.html.twig', ['event_types' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="event_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $eventType = new EventType();
        $form = $this->createForm(EventSortType::class, $eventType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eventType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le type d\'événement '. $eventType->getName() . ' a bien été ajouté !'
            );

            return $this->redirectToRoute('event_type_index_all');
        }

        return $this->render('admin/event_type/new.html.twig', [
            'event_type' => $eventType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_type_show", methods="GET")
     */
    public function show(EventType $eventType): Response
    {
        return $this->render('admin/event_type/show.html.twig', ['event_type' => $eventType]);
    }

    /**
     * @Route("/{id}/edit", name="event_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, EventType $eventType): Response
    {
        $form = $this->createForm(EventSortType::class, $eventType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le type d\'événement '. $eventType->getName() . ' a bien été modifié !'
            );

            return $this->redirectToRoute('event_type_index_all');
        }

        return $this->render('admin/event_type/edit.html.twig', [
            'event_type' => $eventType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_type_delete", methods="DELETE")
     */
    public function delete(Request $request, EventType $eventType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventType->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eventType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le type d\'événement '. $eventType->getName() . ' a bien été supprimé !'
            );
        }

        return $this->redirectToRoute('event_type_index_all');
    }
}
