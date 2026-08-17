<?php

namespace App\Controller\Admin;

use App\Entity\AppUser;
use App\Form\AppUserType;
use App\Repository\AppUserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @Route("/admin/appuser")
 */
class AppUserController extends BaseController
{
    /**
     * @Route("/", name="app_user_index_all", methods={"GET"})
     */
    public function index(AppUserRepository $appUserRepository): Response
    {
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $appUserRepository->getAllAdminAppUsers()]);
    }

    /**
     * @Route("/page/{page}", name="app_user_index", methods={"GET"})
     * @param integer $page
     */
     public function indexAdmin($page)
     {
         
         $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
         $users = $appUserRepository->getAllAdminAppUsers($page);
         $totalUsers = $users->count();
         $iterator = $users->getIterator();
         $maxPages = ceil($totalUsers / 10);
         $thisPage = $page;
         
         return $this->render('admin/app_user/index.html.twig', ['app_users' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);
    }
        
    /**
    * @Route("/spectators/{page}", name="app_user_index_appusers", methods={"GET"})
    * @param integer $page
    */
    public function indexAdminAppUser($page)
    {
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $users = $appUserRepository->getAllAdminSpectators($page);
        $totalUsers = $users->count();
        $iterator = $users->getIterator();
        $maxPages = ceil($totalUsers / 10);
        $thisPage = $page;
    
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);

    }

    /**
    * @Route("/artists/{page}", name="app_user_index_artists", methods={"GET"})
    * @param integer $page
    */
    public function indexAdminArtists($page)
    {
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $users = $appUserRepository->getAllAdminArtists($page);
        $totalUsers = $users->count();
        $iterator = $users->getIterator();
        $maxPages = ceil($totalUsers / 10);
        $thisPage = $page;
    
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);

    }

    /**
    * @Route("/organizers/{page}", name="app_user_index_organizers", methods={"GET"})
    * @param integer $page
    */
    public function indexAdminOrganizers($page)
    {
        $appUserRepository = $this->getDoctrine()->getRepository(AppUser::class);
        $users = $appUserRepository->getAllAdminOrganizers($page);
        $totalUsers = $users->count();
        $iterator = $users->getIterator();
        $maxPages = ceil($totalUsers / 10);
        $thisPage = $page;
    
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $iterator, 'maxPages' => $maxPages, 'thisPage' => $thisPage]);

    }

    /**
     * @Route("/spectators/all", name="app_user_index_spectators_all", methods={"GET"})
     */
    public function indexSpectators(AppUserRepository $appUserRepository): Response
    {
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $appUserRepository->findBy(
            ['role' => 28])]);
    }

    /**
     * @Route("/artists/all", name="app_user_index_artist_all", methods={"GET"})
     */
    public function indexArtist(AppUserRepository $appUserRepository): Response
    {
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $appUserRepository->findBy(
            ['role' => 29])]);
    }

    /**
     * @Route("/organizers/all", name="app_user_index_organizer_all", methods={"GET"})
     */
    public function indexOrganizer(AppUserRepository $appUserRepository): Response
    {
        return $this->render('admin/app_user/index.html.twig', ['app_users' => $appUserRepository->findBy(
            ['role' => 30])]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $appUser = new AppUser();
        $form = $this->createForm(AppUserType::class, $appUser);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $password = $appUser->getPassword();
            $hash = $encoder->hashPassword($appUser, $password);
                    
            $appUser->setPassword($hash);

            $em->persist($appUser);
            $em->flush();

            $this->addFlash(
                'notice',
                'L\'utilisateur '. $appUser->getName() . ' a bien été créé !'
            );

            return $this->redirectToRoute('app_user_index_all');
        }

        return $this->render('admin/app_user/new.html.twig', [
            'app_user' => $appUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(AppUser $appUser): Response
    {
        return $this->render('admin/app_user/show.html.twig', ['app_user' => $appUser]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AppUser $appUser): Response
    {
        $form = $this->createForm(AppUserType::class, $appUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Les modifications ont été apportées à l\'utilisateur !'
            );

            return $this->redirectToRoute('app_user_index_all');
        }

        return $this->render('admin/app_user/edit.html.twig', [
            'app_user' => $appUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"DELETE"})
     */
    public function delete(AuthorizationCheckerInterface $authChecker,Request $request, AppUser $appUser) : Response 
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if($appUser === $currentUser || $authChecker->isGranted('ROLE_ADMINISTRATOR')) 
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appUser);
            $em->flush();
        }
        return $this->redirectToRoute('app_user_index_all');
        
    }
}
