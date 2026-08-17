<?php

namespace App\Controller\Admin;

use App\Entity\PlaceType;
use App\Form\PlaceSortType;
use App\Repository\PlaceTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/place/type")
 */
class PlaceTypeController extends Controller
{
    /**
     * @Route("/", name="place_type_index_all", methods="GET")
     */
    public function index(PlaceTypeRepository $placeTypeRepository): Response
    {
        return $this->render('admin/place_type/index.html.twig', ['place_types' => $placeTypeRepository->findAll()]);
    }

    /**
     * @Route("/page/{page}", name="place_type_index", methods="GET")
     * @param integer $page
     */
    public function indexAdmin($page)
    {
        
        $placeTypeRepository = $this->getDoctrine()->getRepository(PlaceType::class);
        $placeTypes = $placeTypeRepository->getAllAdminPlaceTypes($page);
        $totalPlaceTypes = $placeTypes->count();
        $iterator = $placeTypes->getIterator();
        $maxPages = ceil($totalPlaceTypes / 10);
        $thisPage = $page;
        
        return $this->render('admin/place_type/index.html.twig', ['place_types' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="place_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $placeType = new PlaceType();
        $form = $this->createForm(PlaceSortType::class, $placeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($placeType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le type de lieu '. $placeType->getName() . ' a bien été ajouté !'
            );

            return $this->redirectToRoute('place_type_index_all');
        }

        return $this->render('admin/place_type/new.html.twig', [
            'place_type' => $placeType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="place_type_show", methods="GET")
     */
    public function show(PlaceType $placeType): Response
    {
        return $this->render('admin/place_type/show.html.twig', ['place_type' => $placeType]);
    }

    /**
     * @Route("/{id}/edit", name="place_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, PlaceType $placeType): Response
    {
        $form = $this->createForm(PlaceSortType::class, $placeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le type de lieu '. $placeType->getName() . ' a bien été modifié !'
            );

            return $this->redirectToRoute('place_type_index_all');
        }

        return $this->render('admin/place_type/edit.html.twig', [
            'place_type' => $placeType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="place_type_delete", methods="DELETE")
     */
    public function delete(Request $request, PlaceType $placeType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$placeType->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($placeType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le type de lieu '. $placeType->getName() . ' a bien été supprimé !'
            );

        }

        return $this->redirectToRoute('place_type_index_all');
    }
}
