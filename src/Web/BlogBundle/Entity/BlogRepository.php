<?php

namespace Web\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Clase repositorio para la entidad Blog
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class BlogRepository extends EntityRepository
{
    /**
     * Seleccionamos una cantidad de blogs ordenados por fecha descendente, esta cantidad está delimitada por la 
     * $limit, en el caso de que no estubiera definida $limit o su valor es igual o menor que cero se envia todos los
     * blogs encotrados.
     *
     * @param integer $limit limíte de busquedas
     * @param integer $offset número de la fila desde la que empezar a contar  
     * @return Blog
     */
    public function findOrderedBlogs($limit = 4, $offset = 0)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT b, c, t
            FROM BlogBundle:Blog b
            LEFT JOIN b.comments c
            LEFT JOIN b.tags t
            ORDER BY b.updated DESC'
        );

        $query->setFirstResult($offset)->setMaxResults($limit);
        $paginator = new Paginator($query, $fetchJoinCollection = true);

        return $paginator;
    }

    /**
     * Busca todos los Blog que se relacionen con algún Tag y devuelve ambos
     * 
     * @return array
     */
    public function findAllRelatingToTags()
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT b, t
             FROM BlogBundle:Blog b
             JOIN b.tags t'
        );

        return $query->getResult();
    }

    /**
     * Busca todos los Blog que se relacionanen con un Tag concreto
     *
     * @param string $slug slug de la etiqueta por la que se buscaran log blogs 
     * 
     * @return array
     */
    public function findForATag($slug)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT b
             FROM BlogBundle:Blog b
             JOIN b.tags t
             WHERE t.slug = :slug
             ORDER BY b.created DESC'
        );

        $query->setParameter('slug', $slug);

        return $query->getResult();
    }
}