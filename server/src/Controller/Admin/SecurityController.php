<?php

namespace App\Controller\Admin;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends Controller
{

    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(Request $request, AuthenticationUtils $authenti)
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