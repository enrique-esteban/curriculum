<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\Curriculum;

/**
 * Datos de prueba para la entidad Curriculum
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadCurriculumData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $curriculum = new Curriculum();

        $curriculum->setOwner($this->getReference('user_curriculum'));
        $curriculum->setCareer('Desarrollador de aplicaciones informáticas');
        $curriculum->setDescription('TBD');
        $curriculum->setSkypeUsername('ense.esteban');

        $manager->persist($curriculum);

        $this->addReference('curriculum', $curriculum);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}