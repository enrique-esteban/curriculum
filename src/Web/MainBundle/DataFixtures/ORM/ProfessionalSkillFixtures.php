<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\ProfessionalSkill;


/**
 * Datos de prueba para la entidad ProfessionalSkill
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadProfessionalSkillData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Insertamos una habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('HTML5-CSS3');
        $professionalSkill->setGroup($this->getReference('desarrollo-web'));
        $professionalSkill->setPercentage(90);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('PHP-MySQL');
        $professionalSkill->setGroup($this->getReference('desarrollo-web'));
        $professionalSkill->setPercentage(60);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('JavaScript');
        $professionalSkill->setGroup($this->getReference('desarrollo-web'));
        $professionalSkill->setPercentage(10);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Symfony');
        $professionalSkill->setGroup($this->getReference('cmd'));
        $professionalSkill->setPercentage(70);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Prestashop');
        $professionalSkill->setGroup($this->getReference('cmd'));
        $professionalSkill->setPercentage(60);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Java');
        $professionalSkill->setGroup($this->getReference('desarrollo'));
        $professionalSkill->setPercentage(40);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('C-C++');
        $professionalSkill->setGroup($this->getReference('desarrollo'));
        $professionalSkill->setPercentage(50);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Visual Studio.Net-C#');
        $professionalSkill->setGroup($this->getReference('desarrollo'));
        $professionalSkill->setPercentage(60);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Adobe Photoshop');
        $professionalSkill->setGroup($this->getReference('diseño'));
        $professionalSkill->setPercentage(80);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Adobe Illustrator');
        $professionalSkill->setGroup($this->getReference('diseño'));
        $professionalSkill->setPercentage(60);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Google Analytics');
        $professionalSkill->setGroup($this->getReference('otros'));
        $professionalSkill->setPercentage(60);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('BASH/Scripting');
        $professionalSkill->setGroup($this->getReference('otros'));
        $professionalSkill->setPercentage(90);

        $manager->persist($professionalSkill);


        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkill();

        $professionalSkill->setCurriculumId($this->getReference('curriculum'));
        $professionalSkill->setName('Unity3D');
        $professionalSkill->setGroup($this->getReference('otros'));
        $professionalSkill->setPercentage(50);

        $manager->persist($professionalSkill);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
} 
