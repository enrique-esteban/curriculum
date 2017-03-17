<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\Service;

/**
 * Datos de prueba para la entidad Service
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadServiceData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Añadimos un servicio:
        $service = new Service();
        
        $service->setCurriculumId($this->getReference('curriculum'));
        $service->setName('Desarrollo Web');
        $service->setDescription('Desarrollo web usando las últimas tecnologías con el framework Symfony. Gestores de contenido como Prestashop para tiendas on-line.');
        $service->setIcon('tools');

        $manager->persist($service);

        // Añadimos otro servicio:
        $service = new Service();
        
        $service->setCurriculumId($this->getReference('curriculum'));
        $service->setName('Mantenimiento');
        $service->setDescription('Asistencia 24h. para solucionar problemas y/o dudas.');
        $service->setIcon('lifebuoy');

        $manager->persist($service);

        // Añadimos un servicio:
        $service = new Service();
        
        $service->setCurriculumId($this->getReference('curriculum'));
        $service->setName('Marketing');
        $service->setDescription('Optimización SEO para motores de búsqueda, así como Adword para SEM y servicio de CM para la Social Media.');
        $service->setIcon('megaphone');

        $manager->persist($service);

        // Añadimos un servicio:
        $service = new Service();
        
        $service->setCurriculumId($this->getReference('curriculum'));
        $service->setName('Diseño');
        $service->setDescription('Diseños modernos para su web, aprovechando las últimas tecnologías HTML5/CSS3 como Responsive Desing.');
        $service->setIcon('monitor');

        $manager->persist($service);

        // Añadimos un servicio:
        $service = new Service();
        
        $service->setCurriculumId($this->getReference('curriculum'));
        $service->setName('Branding');
        $service->setDescription('Potencie su marca de su empresa haciendo uso las nuevas tecnologías de la información.');
        $service->setIcon('lamp');

        $manager->persist($service);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}