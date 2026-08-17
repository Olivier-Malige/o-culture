<?php

namespace App\Controller\Admin;

use App\Entity\ArtistType;
use App\Form\ArtistSortType;
use App\Repository\ArtistTypeRepository;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/artisttype")
 */
class ArtistTypeController extends BaseController
{
    /**
     * @Route("/", name="artist_type_index_all", methods={"GET"})
     */
    public function index(ArtistTypeRepository $artistTypeRepository): Response
    {
        return $this->render('admin/artist_type/index.html.twig', ['artist_types' => $artistTypeRepository->findAll()]);
    }

    /**
     * @Route("/page/{page}", name="artist_type_index", methods={"GET"})
     * @param integer $page
     */
    public function indexAdmin($page)
    {
        $artistTypeRepository = $this->getDoctrine()->getRepository(ArtistType::class);
        $artistTypes = $artistTypeRepository->getAllAdminArtistTypes($page);
        $totalArtistTypes = $artistTypes->count();
        $iterator = $artistTypes->getIterator();
        $maxPages = ceil($totalArtistTypes / 10);
        $thisPage = $page;

        return $this->render('admin/artist_type/index.html.twig', ['artist_types' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="artist_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artistType = new ArtistType();
        $form = $this->createForm(ArtistSortType::class, $artistType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artistType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le type d\'artiste '. $artistType->getName() . ' a bien été créé !'
            );

            return $this->redirectToRoute('artist_type_index_all');
        }

        return $this->render('admin/artist_type/new.html.twig', [
            'artist_type' => $artistType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_type_show", methods={"GET"})
     */
    public function show(ArtistType $artistType): Response
    {
        return $this->render('admin/artist_type/show.html.twig', ['artist_type' => $artistType]);
    }

    /**
     * @Route("/{id}/edit", name="artist_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArtistType $artistType): Response
    {
        $form = $this->createForm(ArtistSortType::class, $artistType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le type d\'artiste '. $artistType->getName() . ' a bien été modifié !'
            );

            return $this->redirectToRoute('artist_type_index_all');
        }

        return $this->render('admin/artist_type/edit.html.twig', [
            'artist_type' => $artistType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ArtistType $artistType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artistType->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artistType);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le type d\'artiste '. $artistType->getName() . ' a bien été supprimé !'
            );
        }

        return $this->redirectToRoute('artist_type_index_all');
    }
}
