<?php

namespace Web\UserBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulario de signout para usuarios sin permisos de administrador
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class UserType extends AbstractType
{
    /**
     * Construlle un formulario
     *
     * @param FormBuilderInterface $builder
     * @param arrya $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('username')
			->add('email', 'email')
			->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Las contraseñas deben coincidir',
                    'first_options' => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repita la contraseña')
                )
            )
            ->add('image', 'file', array('required' => false))
            ->add('first_name', 'text', array('required' => false))
            ->add('last_name', 'text', array('required' => false))
			->add('birthday', 'birthday')
			->add('nationality', 'text', array('required' => false))
			->add('allow_spam', 'checkbox', array('required' => false))
            ->add('Registrar', 'submit', array('attr' => array('class' => 'button')));
    }

    /**
     * Establece las opciones generales del formulario, como la clase base que utiliza
     *
     * @param OptionsResolverInterface $resolver
     * @param arrya $options
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\UserBundle\Entity\User'
        ));
    }

    /**
     * Establece un nombre para el formulario
     *
     * @return strign
     */
    public function getName()
    {
        return 'web_userbundle_user';
    }
}