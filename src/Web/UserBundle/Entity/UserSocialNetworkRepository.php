<?php

namespace Web\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Clase repositorio para la entidad UserSocialNetwork
 *
 * Ruta del fichero: src/Web/UserBundle/Entity/UserRepository.php
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class UserSocialNetworkRepository extends EntityRepository 
{
    /**
     * Carga el usuario pasado como parametro
     *
     * @param string $username
     * @return User
     */
    public function findSocialNetworksByUser($user) {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
                'SELECT usn, sn
                 FROM UserBundle:UserSocialNetwork usn
                 JOIN usn.snId sn
                 WHERE usn.userId = :user'
            );

        $query->setParameters('userId', $user);        
        
        return $query->getResult();
    }
}
