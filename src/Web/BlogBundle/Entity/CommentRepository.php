<?php

namespace Web\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Clase repositorio para la entidad Comment
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class CommentRepository extends EntityRepository
{
    /**
     * Seleccionamos todos los comentarios asociados a una entidad Blog dada por su slug, devuelve comentarios
     *     aprovados (por defecto) o no aprovados pero no ambos a la vez.
     *
     * @param string $blogSlug
     * @param boolean $aproved
     * @return Comment
     */
    public function findCommentsByBlogSlug($blogSlug, $approved = true)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT c
            FROM BlogBundle:Comment c
            JOIN c.blog b
            WHERE b.slug = :slug AND c.approved = :approved
            ORDER BY c.created DESC'
        );
        $query->setParameters(array(
            'slug' => $blogSlug,
            'approved' => $approved,
        ));

        return $query->getResult();
    }
}