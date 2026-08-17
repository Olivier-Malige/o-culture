<?php

namespace App\Controller\Admin;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends BaseController
{

    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $authenti)
    {
        // permet de se logger

        $error = $authenti->getLastAuthenticationError();
        $lastUsername = $authenti->getLastUsername();

        return $this->render('security/login.html.twig', [
            'lastUser' => $lastUsername,
            'error' => $error
        ]);

    }
}