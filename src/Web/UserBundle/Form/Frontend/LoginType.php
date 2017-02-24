<?
    namespace Web\UserBundle\Form\Frontend;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;
    
    /**
     * Formulario del login
     *
     * ruta del archivo: src/Web/UserBundle/Form/Frontend/LoginType.php
     *
     * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
     */
    class NameType extends AbstractType
    {
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('username')
                ->add('password', 'email')
                ->add('submit', 'submit');
        }
    
        /**
         * {@inheritdoc}
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'Web\UserBundle\Entity\User',
            ));
        }
    
        /**
         * {@inheritdoc}
         */
        public function getName()
        {
            return 'login_form';
        }
    }