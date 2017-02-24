<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Clase repositorio para la entidad Curriculum
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class CurriculumRepository extends EntityRepository
{
    /**
     * Busca un curriculum asociado a un usuario
     *  
     * NOTA: La aplicación está adaptada para albergar varios curriculums para los usuarios, pero en la
     *       actualidad sólo existe un curriculum para un usuario.
     *
     * @param string $owner
     * @return Curriculum
     */
    public function findOneCurriculumByOwner ($owner)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT c
             FROM MainBundle:Curriculum c
             WHERE c.owner = :owner'
            )
            ->setParameter('owner', $owner)
            ->getOneOrNullResult();

        return $query;
    }
}
