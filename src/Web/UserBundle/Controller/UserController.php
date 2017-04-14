<?php

namespace Web\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//  Clase utilizada para comprobar la autentificación de un usuario:
use Symfony\Component\Security\Core\SecurityContext;

// Clases necesarias para manejar la entidad Usuario y su formulario:
use Web\UserBundle\Entity\User;
use Web\UserBundle\Form\Frontend\UserType;

// Excepciones:
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 * Controlador del usuario relacionado con la busqueda y presentación de la información
 *    Nota: la lógica para la autentificación de usuarios está en AuthenticationController.php
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class UserController extends Controller
{
    /**
     * Muestra un perfil de usuario, encontrado por su id
     *
     * @Route("/show/{id}/", name="show_user_by_id", requirements={"id": "\d+"})
     * Tamplate("serBundle:User:show.html.twig", vars={"id"})
     *
     * @param string $id Id de un usuario
     */
    public function showForIdAction($id)
    {
        // Se busca los datos del usuario solicitado
        $em = $this->getDoctrine()->getManager();
        
        $userRequest = $em->getRepository('UserBundle:User')->findOneById();

        // En el caso de que no exista el usuario se genera una excepción de tipo 'NotFoundHttpException'
        if (!$userRequest) {
            throw $this->createNotFoundException('Unable to find user profler.');
        }

        /*// Se obtiene el usuario logueado a travez de la sesión mediante su token
        $userLogged = $this->get('security.context')->getToken()->getUser();

        // Si el usuario solicitado no y el usuario que genera la consulta no son el mismo y no tiene permisos de 
        //     administrador (ROLE_ADMIN) se le niega el acceso
        if ($userRequest->getUsername() != $userLogged->getUsername() && !$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Acceso denegado");
        }*/

        return $this->render('UserBundle:User:show_user.html.twig', array('user' => $userRequest));
    }

    /**
     * Muestra un perfil de usuario
     *
     * @Route("/show/{userName}/", name="show_user_by_username")
     * Tamplate("serBundle:User:show.html.twig", vars={"userName"})
     *
     * @param string $userName Nick del usuario logueado
     */
    public function showForUsernameAction($userName)
    {
        // Se busca los datos del usuario solicitado
        $em = $this->getDoctrine()->getManager();
        
        $userRequest = $em->getRepository('UserBundle:User')->findOneBy(array(
            'username' => $userName
        ));

        /*// En el caso de que no exista el usuario se genera una excepción de tipo 'NotFoundHttpException'
        if (!$userRequest) {
            throw $this->createNotFoundException('Unable to find user profler.');
        }

        // Se obtiene el usuario logueado a travez de la sesión mediante su token
        $userLogged = $this->get('security.context')->getToken()->getUser();

        // Si el usuario solicitado no y el usuario que genera la consulta no son el mismo y no tiene permisos de 
        //     administrador (ROLE_ADMIN) se le niega el acceso
        if ($userRequest->getUsername() != $userLogged->getUsername() && !$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Acceso denegado");
        }*/

        return $this->render('UserBundle:User:show_user.html.twig', array('user' => $userRequest));
    }
}
