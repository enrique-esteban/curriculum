<?php

namespace Web\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\BlogBundle\Entity\Blog;
use Web\BlogBundle\Entity\Comment;
use Web\UserBundle\Entity\User;

use Web\UserBundle\Form\Frontend\UserType;

use Web\UserBundle\Controller\RegisterController;

/**
 * Controla las acciones principales de la sección de Blog.
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class BlogController extends Controller
{
    /**
     * Seleciona un blog por su id para luego mostrarlo a través de la plantilla show_blog
     * 
     * Route("/{id}/", name="blog_show_id")
     * Tamplate("BlogBundle:Blog:show_blog.html.twig", vars={"blog","comment"})
     *
     * @param integer $id Identificador del blog a mostrar
     */
    public function showForIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBlogSlug($blog->getSlug());

        return $this->render('BlogBundle:Blog:show_blog.html.twig', array(
                'blog' => $blog,
                'comments' => $comments,
            )
        );
    }

    /**
     * Selecionamos un blog por su slug (título en minusculas y sin espacios) para luego mostrarlo
     *     a través de la plantilla show_blog
     * 
     * @Route("/{slug}/", name="blog_show_slug")
     * Tamplate("BlogBundle:Blog:show_blog.html.twig", vars={"blog","comments"})
     *
     * @param string $slug título del blog a mostrar en minusculas y sin espacios
     */

    public function showForSlugAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BlogBundle:Blog')->findOneBySlug($slug);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBlogSlug($blog->getSlug());

        return $this->render('BlogBundle:Blog:show_blog.html.twig', array(
               'blog' => $blog,
                'comments' => $comments,
            )
        );
    }

    /**
     * Muestra una lista de los blogs más recientes ordenados por fecha
     *
     * @Route("/", name="recent_blog")
     * Tamplate("BlogBundle:Blog:recent_blogs.html.twig", vars={"blog","comment"})
     */
    public function recentBlogsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogs = $em->getRepository('BlogBundle:Blog')->findLatestBlogs(3);

        return $this->render('BlogBundle:Blog:list_blogs.html.twig', array(
                'blogs' => $blogs,
                'title' => 'Blogs más recientes'
            )
        );
    }
    
    /**
     * Busca todos los blogs que coincidan con una etiqueta (tag) concreta
     *
     * Route("/list/tag/{slug}/", name="blog_list_tag_slug")
     * Tamplate("BlogBundle:Blog:list_blogs.html.twig", vars={"blogs","title"})
     *
     * @param string $slug slug de una etiqueta, utilizada para la busqueda de los blogs
     */
    public function listForTagAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository('BlogBundle:Tag')->findOneBySlug($slug);

        //$blogs = $tag->getBlogs();
        $blogs = $em->getRepository('BlogBundle:Blog')->findForATag($slug);

        return $this->render('BlogBundle:Blog:list_blogs.html.twig', array(
                'blogs' => $blogs,
                'title' => 'Blogs con la etiqueta '.$tag->getName()
            )
        );
    }

    /**
     *  
     *
     * Route("", name="")
     */
    public function blogSignupAction () {
        /*$request = $this->getRequest();

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

            // Se comprueba si se especificó el Admin (en caso de que un usuario no administrador enviara
            //     el formulario) en ese caso se establece la propiedad a su valor por defecto (false)
            if (!$user->getAdmin()) {
                $user->setAdmin(false);
            }

            // Se guarda la entidad en la base de datos
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Una vez en nuevo usuario ha sido guardado se envia un email de validación para poder activar
            //    la cuenta
            $message = \Swift_Message::newInstance()
                ->setSubject('Email de validación de usuarios en URL')
                ->setFrom('admin@admin.com')
                ->setTo($user->getEmail())
                ->setBody($this->renderView('UserBundle:Register:activation_mail.txt.twig', array('user' => $user)), 'text/html');

            $this->get('mailer')->send($message);

            // Finalmente se vuelve a la página principal
            return $this->redirect($this->generateUrl('user_signup'));
        }

        return $this->render('BlogBundle:Blog:blog_signup.html.twig', array('form' => $form->createView()));
        */
        return $this->render('BlogBundle:Blog:blog_signup.html.twig');

    }
}
