<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\ProfessionalSkillGroup;


/**
 * Datos de prueba para la entidad ProfessionalSkillGroup
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadProfessionalSkillGroupData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Insertamos una habilidad profesional:
        $professionalSkill = new ProfessionalSkillGroup();

        $professionalSkill->setName('Web');
        $professionalSkill->setSlug('web');
        $professionalSkill->setCssClass('dev');

        $this->addReference('desarrollo-web', $professionalSkill);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkillGroup();

        $professionalSkill->setName('Framework');
        $professionalSkill->setSlug('framework');
        $professionalSkill->setCssClass('dev');

        $this->addReference('framework', $professionalSkill);

        $manager->persist($professionalSkill);

        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkillGroup();

        $professionalSkill->setName('Diseño');
        $professionalSkill->setSlug('desing');
        $professionalSkill->setCssClass('des');

        $this->addReference('diseño', $professionalSkill);

        $manager->persist($professionalSkill);
        
        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkillGroup();

        $professionalSkill->setName('Dev');
        $professionalSkill->setSlug('dev');
        $professionalSkill->setCssClass('dev');

        $this->addReference('desarrollo', $professionalSkill);

        $manager->persist($professionalSkill);


        // Insertamos otra habilidad profesional:
        $professionalSkill = new ProfessionalSkillGroup();

        $professionalSkill->setName('Otros');
        $professionalSkill->setSlug('others');
        $professionalSkill->setCssClass('prs');

        $this->addReference('otros', $professionalSkill);

        $manager->persist($professionalSkill);

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
