<?php
 
namespace Web\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\UserBundle\Entity\User;

// Se "inyecta" el contenedor de servicios para así poder codificar el password con el servicio 
//     'security.encoder_factory'
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Datos de prueba para la entidad User
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{    
    // En esta variable se cargaran los datos del contenedor de servicios, necesario para acceder
    //    a la configuración de seguridad contenida en el archivo 'Security.ylm'
    private $container; 

    /**
     * Carga el contenedor de servicios para poder ser utilizada en la clase
     *
     * @param ContainerItarface $container Interfaz que representa el contenedor de servicios 
    */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10 ; $i++) { 
            $user = new User();

            $user->setUsername('user'.$i);
            $user->setEmail('user'.$i.'@user.com');
            $user->setSalt(md5(rand()));
            
            // El password coincidirá con el nombre de usuario (usuario1, usuario2...), además se
            //    codificará utilizando el código Salt de forma que utilize la misma configuración 
            //    guardada en el archivo 'Security.ylm'
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
            $uncodedPass = 'user'.$i;
            $encodedPass = $encoder->encodePassword($uncodedPass,$user->getSalt());

            $user->setPassword($encodedPass);
            $user->setFirstName('User'.$i);
            $user->setLastName('User'.$i);
            $user->setPhone(null);
            $user->setAddress(null);
            $user->setNationality('Español');
            
            // La fecha se genera de forma aleatoria para el campo Birthday
            $birth = rand(1970,2010).'-'.rand(1,12).'-'.rand(1,28);
            $user->setBirthday(new \DateTime($birth));

            $user->setAllowSpam(true);
            $user->setAdmin(false);
            $user->setActivated(true);

            $manager->persist($user);

            $this->addReference('user'.$i,$user);
        }


        // Generamos un usuario administrador (admin):
        $user = new User();

        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->setSalt(md5(rand()));

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $uncodedPass = 'admin'; // Password
        $encodedPass = $encoder->encodePassword($uncodedPass,$user->getSalt());
        $user->setPassword($encodedPass);

        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $user->setPhone(null);
        $user->setAddress(null);
        $user->setNationality('Español');
        $user->setBirthday(new \DateTime('now'));

        $user->setAllowSpam(false);
        $user->setAdmin(true);
        $user->setActivated(true);
        
        $manager->persist($user);

        // Generamos un usuario administrador:
        $user = new User();
        
        $user->setUsername('enrique');
        $user->setEmail('ense.esteban@gmail.com');
        $user->setSalt(md5(rand()));

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $uncodedPass = 'ys1fdm.*'; // Pasword
        $encodedPass = $encoder->encodePassword($uncodedPass,$user->getSalt());
        $user->setPassword($encodedPass);

        $user->setFirstName('Enrique');
        $user->setLastName('Esteban Plaza');
        $user->setPhone('677800959');
        $user->setAddress('C/ Martinica nº 5');
        $user->setNationality('Español');
        $user->setBirthday(new \DateTime('15-08-1982'));

        $user->setAllowSpam(false);
        $user->setAdmin(true);
        $user->setActivated(true);
        
        $manager->persist($user);

        $this->addReference('user_curriculum', $user);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}