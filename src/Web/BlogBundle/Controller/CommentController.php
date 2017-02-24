<?php

namespace Web\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Web\BlogBundle\Entity\Comment;
use Web\BlogBundle\Form\CommentType;

/**
 * Controla las acciones principales realizada sobre los comentarios.
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class CommentController extends Controller
{
    /**
     * Procesa y regenera el formulario de los comentarios de los blogs
     * 
     * Route("/comment/{blog_id}/", name="comment_create")
     * Tamplate("", vars={"blog","comment"})
     *
     * @param integer $blog_id Identificador del blog que estará asociado al comentario
     */
    public function createAction($blog_id)
    {
        $request = $this->getRequest();

        $blog = $this->getBlog($blog_id);

        $comment  = new Comment();
        $comment->setBlog($blog);
        
        $form = $this->createForm(new CommentType(), $comment);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            // La mayoría de los campos de la entidad commente están ya definidos (body en el formulario y created,
            //    update, approve cuando se crea) pero aun queda definir algunas:
            
            // Se establece el blog al que pertenece el comentario a través del obtinido con el parametro '$blog_id'
            $comment->setBlog($blog);

            // El autor es necesariamente el usuario actualmente logueado
            $user = $this->get('security.context')->getToken()->getUser();
            $comment->setAuthor($user);

            //ldd($comment);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('blog_show_id', array(
                'id' => $comment->getBlog()->getId()))
            );
        }

        return $this->render('BlogBundle:Comment:comment_form.html.twig', array(
                'blog_id' => $blog_id,
                'form'    => $form->createView()
            )
        );
    }

    /**
     * Buscamos el blog al que pertenece el comentario dado
     *
     * @param integer $blog_id Identificador del blog que estará asociado al comentario
     */
    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BlogBundle:Blog')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }
}
