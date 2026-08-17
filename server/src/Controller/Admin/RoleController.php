<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/role")
 */
class RoleController extends Controller
{
    /**
     * @Route("/", name="role_index", methods="GET")
     */
    public function index(RoleRepository $roleRepository): Response
    {
        return $this->render('admin/role/index.html.twig', ['roles' => $roleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="role_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le role '. $role->getName() . ' a bien été ajouté !'
            );

            return $this->redirectToRoute('role_index');
        }

        return $this->render('admin/role/new.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_show", methods="GET")
     */
    public function show(Role $role): Response
    {
        return $this->render('admin/role/show.html.twig', ['role' => $role]);
    }

    /**
     * @Route("/{id}/edit", name="role_edit", methods="GET|POST")
     */
    public function edit(Request $request, Role $role): Response
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le role '. $role->getName() . ' a bien été modifié !'
            );

            return $this->redirectToRoute('role_index');
        }

        return $this->render('admin/role/edit.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_delete", methods="DELETE")
     */
    public function delete(Request $request, Role $role): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();

            $this->addFlash(
                'notice',
                'Le role '. $role->getName() . ' a bien été supprimé !'
            );
        }

        return $this->redirectToRoute('role_index');
    }
}
