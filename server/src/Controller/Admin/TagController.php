<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tag")
 */
class TagController extends Controller
{
    /**
     * @Route("/", name="tag_index_all", methods="GET")
     */
    public function index(TagRepository $tagRepository): Response
    {
        return $this->render('admin/tag/index.html.twig', ['tags' => $tagRepository->findAll()]);
    }

    /**
     * @Route("/page/{page}", name="tag_index", methods="GET")
     * @param integer $page
     */
    public function indexAdmin($page)
    {
        
        $tagRepository = $this->getDoctrine()->getRepository(Tag::class);
        $tags = $tagRepository->getAllAdminTags($page);
        $totalTags = $tags->count();
        $iterator = $tags->getIterator();
        $maxPages = ceil($totalTags / 10);
        $thisPage = $page;
        
        return $this->render('admin/tag/index.html.twig', ['tags' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="tag_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le tag '. $tag->getName() . ' a bien été ajouté !'
            );

            return $this->redirectToRoute('tag_index_all');
        }

        return $this->render('admin/tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tag_show", methods="GET")
     */
    public function show(Tag $tag): Response
    {
        return $this->render('admin/tag/show.html.twig', ['tag' => $tag]);
    }

    /**
     * @Route("/{id}/edit", name="tag_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le tag '. $tag->getName() . ' a bien été modifié !'
            );

            return $this->redirectToRoute('tag_index_all');
        }

        return $this->render('admin/tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tag_delete", methods="DELETE")
     */
    public function delete(Request $request, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le tag '. $tag->getName() . ' a bien été supprimé !'
            );
        }

        return $this->redirectToRoute('tag_index_all');
    }
}
