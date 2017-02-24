<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\EducationPlace;

/**
 * Datos de prueba para la entidad EducationPlace
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadEducationPlaceData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Insertamos un lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('I.E.S. Pablo Ruiz Picasso');
        $educationPlace->setTitration('Bachillerato tecnológico');
        $educationPlace->setAddress('Chiclana de la Frontera, Cádiz');
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(false);
        $educationPlace->setHours(0);
        $educationPlace->setStartDate(new \DateTime('01-09-2002'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2004'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('I.E.S. Manuel de Falla');
        $educationPlace->setTitration('Ciclo de grado superior en Desarrollo de aplicaciones informaticas');
        $educationPlace->setAddress('Puerto Real, Cádiz');
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(false);
        $educationPlace->setHours(0);
        $educationPlace->setStartDate(new \DateTime('01-09-2011'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2013'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Academia Online Capacity');
        $educationPlace->setTitration('Administrador de sistemas Linux');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(70);
        $educationPlace->setStartDate(new \DateTime('01-09-2014'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2014'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Google Activate');
        $educationPlace->setTitration('Analítica Web');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(40);
        $educationPlace->setStartDate(new \DateTime('01-09-2015'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2015'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Instituto de Marketing Online');
        $educationPlace->setTitration('Posicionamiento en buscadores (SEO y SEM)');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(30);
        $educationPlace->setStartDate(new \DateTime('01-09-2013'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2013'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Instituto de Marketing Online');
        $educationPlace->setTitration('Community Managements');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(30);
        $educationPlace->setStartDate(new \DateTime('01-09-2013'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2013'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Prestashop');
        $educationPlace->setTitration('Junta de Andalucía');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(30);
        $educationPlace->setStartDate(new \DateTime('01-09-2015'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2015'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Junta de Andalucía');
        $educationPlace->setTitration('Dinamizador de cursos e-Learning');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(30);
        $educationPlace->setStartDate(new \DateTime('01-09-2015'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2015'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Coursera');
        $educationPlace->setTitration('Desarrollo de app. web con Symfony2');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(40);
        $educationPlace->setStartDate(new \DateTime('01-09-2014'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2014'));

        $manager->persist($educationPlace);

        // Insertamos otro lugar de estudios:
        $educationPlace = new EducationPlace();
        
        $educationPlace->setCurriculumId($this->getReference('curriculum'));
        $educationPlace->setPlace('Coursera');
        $educationPlace->setTitration('Desarrollo de juegos en 2D con Unity');
        $educationPlace->setAddress(null);
        $educationPlace->setDescription(null);
        $educationPlace->setIsCourse(true);
        $educationPlace->setHours(40);
        $educationPlace->setStartDate(new \DateTime('01-09-2016'));
        $educationPlace->setFinishDate(new \DateTime('01-06-2016'));

        $manager->persist($educationPlace);

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
