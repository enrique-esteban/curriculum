<?php

namespace Web\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Clase repositorio para la entidad Post
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class PostRepository extends EntityRepository
{
    /**
     * Seleccionamos una cantidad de posts ordenados por fecha descendente, tambien implementa la clase paginator
     *    para ordenar los post en páginas, cuyo valor por defecto es de 5 post por página
     *
     * @param integer $limit limíte de busquedas
     * @param integer $offset número de la fila desde la que empezar a contar  
     * @return array
     */
    public function findOrderedPosts($limit = 5, $offset = 0)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT p, c, t
            FROM BlogBundle:Post p
            LEFT JOIN p.comments c
            LEFT JOIN p.tags t
            ORDER BY p.updated DESC'
        );

        $query->setFirstResult($offset)->setMaxResults($limit);
        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
    }

    /**
     * Busca todos los Post relacionados con un Tag concreto
     *
     * @param string $tagSlug slug de la etiqueta por la cual se buscaran los posts 
     * @param integer $limit limíte de busquedas
     * @param integer $offset número de la fila desde la que empezar a contar  
     * @return array
     */
    public function findAllByTag($tagSlug, $limit = 5, $offset = 0)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT p, c, t
            FROM BlogBundle:Post p
            LEFT JOIN p.comments c
            LEFT JOIN p.tags t
            WHERE t.slug = :tag
            '
        )->setParameters(array(
                'tag' => $tagSlug
        ));

        $query->setFirstResult($offset)->setMaxResults($limit);
        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
    }

    /**
     * Busca un post relacionado con un Slug concreto, obteniendo además sus tag and comentarios medienta
     *    un fetch join.
     * 
     * @param string $slug slug de la etiqueta por la cual se buscaran los posts
     * @return Web\BlogBundle\Entity\Post
     */
    public function findOneBySlug($slug)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT p, c, t
             FROM BlogBundle:Post p
             JOIN p.comments c
             JOIN p.tags t
             WHERE p.slug = :slug'
        )->setParameters(array(
                'slug' => $slug
        ));

        return $query->getOneOrNullResult();
    }
}