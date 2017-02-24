<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Clase repositorio para la entidad ProfessionalSkillGroup
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class ProfessionalSkillGroupRepository extends EntityRepository
{
    /**
     * Busca Todas las habilidades profesionles asociadas a un curriculum por grupos
     *
     * @param string $owner
     * @return Curriculum
     */
    public function findByCurriculum ($curriculumId)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT psg, ps
             FROM MainBundle:ProfessionalSkillGroup psg
             JOIN psg.professionalSkills ps
             WHERE ps.curriculumId = :curriculumId'
            )
            ->setParameter('curriculumId', $curriculumId)
            ->getResult();

        return $query;
    }
}
