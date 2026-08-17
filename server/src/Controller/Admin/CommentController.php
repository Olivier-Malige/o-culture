<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\AppUser;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/comment")
 */
class CommentController extends Controller
{
    /**
     * @Route("/", name="comment_index_all", methods="GET")
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('admin/comment/index.html.twig', ['comments' => $commentRepository->findAll()]);
    }

    /**
    * @Route("/{page}", name="comment_index", methods="GET")
    */
    public function indexAdmin($page)
    {
        $commentRepository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $commentRepository->getAllAdminComments($page);
        $totalComments = $comments->count();
        $iterator = $comments->getIterator();
        $maxPages = ceil($totalComments / 10);
        $thisPage = $page;

        return $this->render('admin/comment/index.html.twig', ['comments' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }

    /**
     * @Route("/new", name="comment_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $comment = new Comment();

        $repositoryRole = $this->getDoctrine()->getRepository(Role::class);
        $role = $repositoryRole->findOneBy(['code' => 'ROLE_ADMINISTRATOR']);
                
        $repositoryUser = $this->getDoctrine()->getRepository(AppUser::class);
        $user = $repositoryUser->findOneBy(['role' => $role]);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAppUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le commentaire a bien été ajouté !'
            );

            return $this->redirectToRoute('comment_index_all');
        }

        return $this->render('admin/comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods="GET")
     */
    public function show(Comment $comment): Response
    {
        return $this->render('admin/comment/show.html.twig', ['comment' => $comment]);
    }

    /**
     * @Route("/{id}/edit", name="comment_edit", methods="GET|POST")
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Le commentaire a bien été modifié !'
            );
            return $this->redirectToRoute('comment_index_all');
        }

        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_delete", methods="DELETE")
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le commentaire a bien été supprimé !'
            );
        }

        return $this->redirectToRoute('comment_index_all');
    }
}
