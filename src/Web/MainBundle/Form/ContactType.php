<?
namespace Web\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulario de contacto para visitantes de la web.
 *
 * ruta del archivo: src/Web/MainBundle/Form/ContactType.php
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','Nombre')
                ->add('email','email')
                ->add('subject')
                ->add('body','textarea');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\UserBundle\Entity\Users'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contact_form';
    }
}