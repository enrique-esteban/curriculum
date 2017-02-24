<?php

namespace Web\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//  Clase utilizada para comprobar la autentificación de un usuario:
use Symfony\Component\Security\Core\SecurityContext;


/**
 * Controlador del login de Usuarios
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class AuthenticationController extends Controller
{
    /**
     * Controla el login de un usuario
     *
     * Route("/login/", name="user_login")
     * Tamplate("serBundle:User:login.html.twig")
     */
    public function loginAction()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();

    	//Si captura los errores de seguridad en caso de que existan
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

    	return $this->render('UserBundle:Authentication:login.html.twig', array(
    		'last_username' => $session->get(SecurityContext::LAST_USERNAME),
    		'error' => $error,
    	));
    }


    /**
     * Action que controla la caja de login de la barra superior de la web
     *
     * Route("/login_box/", name="login_box")
     * Tamplate("serBundle:User:login_box.html.twig")
     */
    public function loginBoxAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // Si captura los errores de seguridad en caso de que existan
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('UserBundle:Authentication:login_box.html.twig', array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error,
            )
        );
    }
}
