<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * User login process, if user is already loggedin redirect to
     * welcome page.
     *
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('welcome');
        }
       $helper = $this->get('security.authentication_utils');

       return $this->render(
           'auth/login.html.twig',
           array(
               'last_username' => $helper->getLastUsername(),
               'error'         => $helper->getLastAuthenticationError(),
           )
       );
    }

    /**
     * Check is user loggedin.
     *
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * Logout action.
     *
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}
