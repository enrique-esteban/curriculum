<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\WorkExperience;


/**
 * Datos de prueba para la entidad EducationPlace
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadWorkExperienceData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Añadimos una experiencia laboral:
        $workExperience = new WorkExperience();

        $workExperience->setCurriculumId($this->getReference('curriculum'));
        $workExperience->setCompany('Pintura Industrial Ramos Mejías S.A.');
        $workExperience->setJobTitle('Pintor - Oficial de primera');
        $workExperience->setDescription('Desempeñando principalmente la labor de pintor en el sector de la construcción en la bahía de Cádiz para la empresa Ramos Mejias de Chiclana de la Frontera, Cádiz.');
        $workExperience->setStartDate(new \DateTime('01-01-2014'));
        $workExperience->setFinishDate(new \DateTime('now'));
        $workExperience->setNumberOfYears(4);
        $workExperience->setIsCurrent(false);

        $manager->persist($workExperience);

        // Añadimos otra experiencia laboral:
        $workExperience = new WorkExperience();

        $workExperience->setCurriculumId($this->getReference('curriculum'));
        $workExperience->setCompany('Melia Hoteles');
        $workExperience->setJobTitle('Mozo de piscina/playa');
        $workExperience->setDescription('Atención al cliente en el departamento de Piscina y Playa para el hotel Melia Santi Petri de Chiclana de la Frontera, Cádiz.');
        $workExperience->setStartDate(new \DateTime('01-01-2012'));
        $workExperience->setFinishDate(new \DateTime('now'));
        $workExperience->setNumberOfYears(2);
        $workExperience->setIsCurrent(false);

        $manager->persist($workExperience);

        // Añadimos otra experiencia laboral:
        $workExperience = new WorkExperience();

        $workExperience->setCurriculumId($this->getReference('curriculum'));
        $workExperience->setCompany('Asociación de Pescadores Caño Chanarro');
        $workExperience->setJobTitle('Camarero');
        $workExperience->setDescription('Trabajo como camarero para la asociación de pescadores Caño Chanarro del poblado de Santi Petri en Chiclana de la Frontera, Cádiz.');
        $workExperience->setStartDate(new \DateTime('01-01-2013'));
        $workExperience->setFinishDate(new \DateTime('now'));
        $workExperience->setNumberOfYears(3);
        $workExperience->setIsCurrent(false);

        $manager->persist($workExperience);

        // Añadimos otra experiencia laboral:
        $workExperience = new WorkExperience();

        $workExperience->setCurriculumId($this->getReference('curriculum'));
        $workExperience->setCompany('Varios');
        $workExperience->setJobTitle('Camarero');
        $workExperience->setDescription('Diversos trabajo como camarero para comuniones, bautizos, etc. Y de sustitución en varios bares y chiringuitos de Chiclana de la Frontera, Cádiz');
        $workExperience->setStartDate(new \DateTime('01-01-2011'));
        $workExperience->setFinishDate(new \DateTime('now'));
        $workExperience->setNumberOfYears(4);
        $workExperience->setIsCurrent(false);

        $manager->persist($workExperience);

        // Añadimos otra experiencia laboral:
        $workExperience = new WorkExperience();

        $workExperience->setCurriculumId($this->getReference('curriculum'));
        $workExperience->setCompany('Varios');
        $workExperience->setJobTitle('Desarrollador Web');
        $workExperience->setDescription('Pequeños trabajos como freelancer desarrollando páginas web');
        $workExperience->setStartDate(new \DateTime('01-01-2015'));
        $workExperience->setFinishDate(new \DateTime('now'));
        $workExperience->setNumberOfYears(2);
        $workExperience->setIsCurrent(false);

        $manager->persist($workExperience);

        // Añadimos otra experiencia laboral:
        $workExperience = new WorkExperience();

        $workExperience->setCurriculumId($this->getReference('curriculum'));
        $workExperience->setCompany('Imprentas Hercules');
        $workExperience->setJobTitle('Diseñador gráfico');
        $workExperience->setDescription('Trabajos por encargo de diseños, tanto en Adobe Photoshop como en Illustrator, para la empresa Imprentas Hercules de Chiclana de la Frontera, Cádiz.');
        $workExperience->setStartDate(new \DateTime('01-08-2016'));
        $workExperience->setFinishDate(null);
        $workExperience->setNumberOfYears(0);
        $workExperience->setIsCurrent(true);

        $manager->persist($workExperience);

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
