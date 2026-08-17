<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\Place;
use App\Entity\AppUser;
use App\Form\PlaceType;
use App\Repository\PlaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/place")
 */
class PlaceController extends Controller
{
    /**
     * @Route("/", name="place_index_all", methods="GET")
     */
    public function index(PlaceRepository $placeRepository): Response
    {
        return $this->render('admin/place/index.html.twig', ['places' => $placeRepository->findAll()]);
    }

    /**
     * @Route("/page/{page}", name="place_index", methods="GET")
     * @param integer $page
     */
    public function indexAdmin($page)
    {
        
        $placeRepository = $this->getDoctrine()->getRepository(Place::class);
        $places = $placeRepository->getAllAdminPlaces($page);
        $totalPlaces = $places->count();
        $iterator = $places->getIterator();
        $maxPages = ceil($totalPlaces / 10);
        $thisPage = $page;
        
        return $this->render('admin/place/index.html.twig', ['places' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="place_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $place = new Place();

        $repositoryRole = $this->getDoctrine()->getRepository(Role::class);
        $role = $repositoryRole->findOneBy(['code' => 'ROLE_ADMINISTRATOR']);
                
        $repositoryUser = $this->getDoctrine()->getRepository(AppUser::class);
        $user = $repositoryUser->findOneBy(['role' => $role]);

        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

    
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $comment->setAppUserCreator($user);
            $em->persist($place);
            $em->flush();
            
            $this->addFlash(
                'notice',
                'Le lieu '. $place->getName() . ' a bien été ajouté !'
            );

            return $this->redirectToRoute('place_index_all');
        }

        return $this->render('admin/place/new.html.twig', [
            'place' => $place,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="place_show", methods="GET")
     */
    public function show(Place $place): Response
    {
        return $this->render('admin/place/show.html.twig', ['place' => $place]);
    }

    /**
     * @Route("/{id}/edit", name="place_edit", methods="GET|POST")
     */
    public function edit(Request $request, Place $place): Response
    {
        $form = $this->createForm(PlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le lieu '. $place->getName() . ' a bien été modifié !'
            );

            return $this->redirectToRoute('place_index_all');
        }

        return $this->render('admin/place/edit.html.twig', [
            'place' => $place,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="place_delete", methods="DELETE")
     */
    public function delete(Request $request, Place $place): Response
    {
        if ($this->isCsrfTokenValid('delete'.$place->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($place);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le lieu '. $place->getName() . ' a bien été supprimé !'
            );

        }

        return $this->redirectToRoute('place_index_all');
    }
}
