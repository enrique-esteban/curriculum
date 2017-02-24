<?php

namespace Web\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RequestStack;

// Clases necesarias para manejar la entidad Usuario y su formulario:
use Web\UserBundle\Entity\User;
use Web\UserBundle\Form\Frontend\UserType;


/**
 * Controlador el alta de usuarios
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class RegisterController extends Controller
{
    /**
     * Carga 
     *
     * Route("", name="")
     */
    public function getSignupAction () {
        $request = $this->getRequest();

        $user = new User();

        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);

            // Se calcula el código Salt de forma aleatoria
            $user->setSalt(md5(time()));

            // Luego se codifica el Password utilizando el código Salt como clave
            $encodedPass = $encoder->encodePassword(
                $user->getPassword(),
                $user->getSalt()
            );

            // Se guarda en la entidad el nuevo password
            $user->setPassword($encodedPass);

            // Si no se incluye ninguna imágen se utiliza la imagen por defeto
            if (!$user->getImage()) {
                $user->setImage("/image/profilers/default.png");
            }

            // Se comprueba si se especificó el Admin (en caso de que un usuario no administrador enviara el formulario)
            //     en ese caso se establece la propiedad a su valor por defecto (false)
            if (!$user->getAdmin()) {
                $user->setAdmin(false);
            }

            // Se guarda la entidad en la base de datos
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Una vez en nuevo usuario ha sido guardado se envia un email de validación para poder activar la cuenta
            $message = \Swift_Message::newInstance()
                ->setSubject('Email de validación de usuarios en URL')
                ->setFrom('admin@admin.com')
                ->setTo($user->getEmail())
                ->setBody($this->renderView('UserBundle:Register:activation_mail.txt.twig', array('user' => $user)), 'text/html');

            $this->get('mailer')->send($message);

            // Finalmente se re-dirige a la página de login
            return $this->redirect($this->generateUrl('user_login'));
        }

        return $this->render('UserBundle:Register:signup_base.html.twig', array('form' => $form->createView()));
    }


    /**
     * Valida a un usuario a travez del salt
     *
     * Route("/validate/{salt}/", name="user_validate")
     * Tamplate("serBundle:User:.html.twig")
     *
     * @param string $salt Código aleatorio generado en la creación del usuario
     */
    public function activateAction($salt)
    {
        // Obtenemos el usuario con el salt igual a $salt a travez del entity manager
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $user = $em->getRepository('UserBundle:User')->findOneBySalt($salt);

        // Si no ha encontrado ningún usuario con ese salt se genera una excepción de tipo 'NotFounHttpException'
        if (!$user) {
            throw $this->createNotFoundException();
        }

        // Si no se ha generado la excepción se activará la cuenta del usuario, en caso de que sea necesario
        //     y se guardará los cambiós en la base de datos
        if ($user->getActivated() == false) {
            $user->setActivated(true);

            $em->persist($user);
            $em->flush();
        }

        // Se genera un mensage flash para indicar al usuario que se ha validado correctamente y se redirecciona a la
        //     página de login 
        $this->get('session')->getflashbag()->add('notice', 'Enhorabuena, su cuenta ha sido activada, ya puede loguearse correctamente en nuestra web.');

        return $this->redirect($this->generateUrl('user_login'));
    }
}
