<?php

namespace Web\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

// Clases necesarias para el Proveedor personalizado
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Clase repositorio para la entidad User, además ha sido implementado un proveedor personalizado
 *    para esa entidad, la cual requiere la implementación de tres métodos: loadUserByUsername(),
 *    refreshUser() y supportsClass()
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class UserRepository extends EntityRepository implements UserProviderInterface 
{
    /**
     * Carga el usuario pasado como parametro
     *
     * @param string $username
     * @return User
     */
    public function loadUserByUsername($username) {
        // Seleccionamos el usuario cuyo username o email coincide con la variable username pasada como argumento
        $em = $this->getEntityManager();

        $query = $em->createQuery(
                'SELECT u 
                 FROM UserBundle:User u
                 WHERE u.username = :username
                 OR u.email = :username'
            )
            ->setParameters(array(
                'username' => $username
            ))
            ->getOneOrNullResult();
        
        return $query;
    }

     /**
     * Busca un usuario con todas las sus redes sociales asociadas
     *
     * @param string $username
     * @return User
     */
    public function findOneByUsernameWithSocialNetworks ($username)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT u, usn, sn
             FROM UserBundle:User u
             JOIN u.socialNetworks usn
             JOIN usn.snId sn
             WHERE u.username = :username'
            )
            ->setParameter('username', $username)
            ->getOneOrNullResult();
        
        return $query;
    }

    /**
     * Refresca el usuario de la interfaz
     *
     * @param UserInterface $user
     * @return User
     */
    public function refreshUser(UserInterface $user) {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Devuelve en nombre de la clase/entidad con la que funciona este proveedor
     *
     * @param Object $class
     * @param string
     */
    public function supportsClass($class) {
        return $class === 'Web\UserBundle\Entity\User';
    }
}
