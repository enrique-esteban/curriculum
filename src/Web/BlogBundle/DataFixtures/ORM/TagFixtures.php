<?php
 
namespace Web\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Web\BlogBundle\Entity\Tag;


/**
 * Datos de prueba para la entidad Tag
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com> 
 */
class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10 ; $i++) { 
            $tag = new Tag();

            $tag->setName('Tag'.$i);
            $tag->setSlug('tag'.$i);

            $this->addReference('tag'.$i,$tag);

            $manager->persist($tag);
        }

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