<?php

namespace Web\BlogBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Voter del bundle Blog que comprueba si un usuario tiene permiso para editar un comentario concreto. Nota: Securirty
 *     Voters es una interfaz que utiliza Symfony para la toma de desiciones relacionadas con las autoricaciónes
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class CommentVoter implements VoterInterface
{
    /**
     * Metodo encargado de restringir el alcance de cada voter a unos roles determinados
     * 
     * @param string $atribute nombre del permiso que está usando el usuario
     * 
     * @return boolean
     */
    public function supportsAttribute($attribute)
    {
        return 'ROLE_EDIT_COMMENT' == $attribute;
    }

    /**
     * Comprueba si el voter soporta la clase que representa a la que solicita el permiso
     *
     * @param object $atribute clase que representa a la que solicita el permiso
     * 
     * @return boolean
     */
    public function supportsClass($class)
    {
        return true;
    }

    /**
     * Implementa la lógica de toma de deciciones del voter
     *
     * @param TokenInterface $token permite acceder a los datos del usuario solicitante
     * @param Object $object objeto sobre el que se solicita el acceso (objeto de tipo Comment en este caso)
     * @param array $attributes array con los permisos solicitados
     * 
     * @return VoterInterface
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        foreach ($attributes as $attribute) {
            if (false === $this->supportsAttribute($attribute)) {
                continue;
            }

            // Se obtiene el usuario logueado
            $user = $token->getUser();

            // Se comprueba si el usuario es anonimo
            if ($user == "anon.") {
                return VoterInterface::ACCESS_ABSTAIN;
            }

            // Si el comentario que se edita fue publicada por el usuario logueado es autoriza el acceso
            if ($object->getAuthor()->getId() === $user->getId()) {
                return VoterInterface::ACCESS_GRANTED;
            }
        }

        return VoterInterface::ACCESS_ABSTAIN;
    }
}
