<?php

namespace Web\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Web\BlogBundle\Entity\Post;
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
     * Seleciona un post por su id para luego mostrarlo
     * 
     * Route("/{id}/", name="show_post_by_id", requirements={"id": "\d+"})
     * Tamplate("BlogBundle:Post:show_blog.html.twig", vars={"blog","comment"})
     *
     * @param integer $id Identificador del blog a mostrar
     */
    public function showForIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find the blog post with id: '.$is.'.');
        }

        $comments = $em->getRepository('BlogBundle:Comment')->findCommentsByBlogSlug($post->getSlug());

        return $this->render('BlogBundle:Post:show_blog.html.twig', array(
                'post' => $post,
                'comments' => $comments,
            )
        );
    }

    /**
     * Seleciona un post por su slug para luego mostrarlo
     * 
     * @Route("/{query}/", name="show_post_by_slug")
     * Tamplate("BlogBundle:Post:show_sigle_post.html.twig", vars={"post","comment"})
     *
     * @param string $query Slug del post a mostrar
     */
    public function showBySlugAction($query)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Post')->findOneBySlug($query);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find the blog post with slug: '.$query.'.');
        }

        return $this->render('BlogBundle:Post:show_post.html.twig', array(
                'title' => $post->getTitle(),
                'post' => $post,
            )
        );
    }

    /**
     * Muestra una lista de los tres posts más recientes ordenados por fecha descendente
     *
     * @Route("/recent", name="recent_posts")
     * Tamplate("BlogBundle:Post:list_posts.html.twig", vars={"posts", "title", "paginator"})
     */
    public function listRecentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Post')->findOrderedPosts(3);

        // Creamos un array con los parametros necesarios para el paginador
        $paginator = array(
            'show' => false,
            'route' => 'list_all_posts',
        );

        return $this->render('BlogBundle:Post:list_posts.html.twig', array(
                'posts' => $posts,
                'title' => 'Últimas novedades',
                'paginator' => $paginator,
            )
        );
    }


    /**
     * Muestra una lista de todos los posts, ordenados por fecha descendente
     *
     * @Route("/all/page/{page}", name="list_all_posts", requirements={"page": "\d+"})
     * Tamplate("BlogBundle:Post:list_posts.html.twig", vars={"posts","title", "paginator"})
     *
     * @param integer $page número de la página a visualizar 
     */
    public function listAllAction($page)
    {
        $pageSize = 4; // Número de post vizualizados por página
        $firstPost = ($page - 1) * $pageSize; // Primer post que se vizualizará en cada página

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Post')->findOrderedPosts($pageSize, $firstPost);

        // Obtenemos el número total de páginas
        $pageCount = ceil(count($posts) / $pageSize);

        // Creamos un array con los parametros necesarios para el paginador
        $paginator = array(
            'show' => 'true',
            'currentPage' => $page,
            'pageCount' => $pageCount,
            'route' => 'list_all_posts',
        );

        return $this->render('BlogBundle:Post:list_posts.html.twig', array(
                'posts' => $posts,
                'title' => 'Lista de todos los post',
                'paginator' => $paginator,
            )
        );
    }

     /**
     * Busca todos los posts que coincidan con una etiqueta (tag) concreta
     *
     * @Route("/tag/{query}/page/{page}", name="list_posts_by_tag", requirements={"page": "\d+"})
     * Tamplate("BlogBundle:Post:list_posts.html.twig", vars={"posts","title", "paginator"})
     *
     * @param string $query slug de una etiqueta, utilizada para la busqueda de los posts
     * @param integer $page número de la página a visualizar
     */
    public function listByTagAction($query, $page)
    {
        $pageSize = 4; // Número de post vizualizados por página
        $firstPost = ($page - 1) * $pageSize; // Primer post que se vizualizará en cada página

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Post')->findAllByTag($query, $pageSize, $firstPost);

        // Obtenemos el número total de páginas
        $pageCount = ceil(count($posts) / $pageSize);

        // Creamos un array con los parametros necesarios para el paginador
        $paginator = array(
            'show' => true,
            'currentPage' => $page,
            'pageCount' => $pageCount,
            'route' => 'list_posts_by_tag',
            'query'=> $query,
        );

        return $this->render('BlogBundle:Post:list_posts.html.twig', array(
                'posts' => $posts,
                'title' => 'Post con la etiqueta '.$query,
                'paginator' => $paginator,
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

        return $this->render('BlogBundle:Post:blog_signup.html.twig', array('form' => $form->createView()));
        */
        return $this->render('BlogBundle:Post:blog_signup.html.twig');

    }
}
