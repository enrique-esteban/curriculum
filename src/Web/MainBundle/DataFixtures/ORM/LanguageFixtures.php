<?php
 
namespace Web\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\MainBundle\Entity\Language;


/**
 * Datos de prueba para la entidad Language
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadLanguageData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        // Insertamos un lenguaje:
        $language = new Language();

        $language->setCurriculumId($this->getReference('curriculum'));
        $language->setLanguage('Inglés');
        $language->setProficiency('Medio');

        $manager->persist($language);

        // Insertamos otro lenguaje:
        $language = new Language();
        
        $language->setCurriculumId($this->getReference('curriculum'));
        $language->setLanguage('Francés');
        $language->setProficiency('Bajo');

        $manager->persist($language);

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
