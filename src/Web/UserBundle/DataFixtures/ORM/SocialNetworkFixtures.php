<?php
 
namespace Web\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\UserBundle\Entity\SocialNetwork;


/**
 * Datos de prueba para la entidad SocialNetwork
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadSocialNetworkData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        // Insertamos una red social:
        $socialNetwork = new SocialNetwork();

        $socialNetwork->setName('Facebook');
        $socialNetwork->setIcon('icon-facebook');

        $this->addReference('sn-facebook', $socialNetwork);

        $manager->persist($socialNetwork);

        // Insertamos otra red social:
        $socialNetwork = new SocialNetwork();

        $socialNetwork->setName('Twitter');
        $socialNetwork->setIcon('icon-twitter');

        $this->addReference('sn-twitter', $socialNetwork);

        $manager->persist($socialNetwork);

        // Insertamos otra red social:
        $socialNetwork = new SocialNetwork();

        $socialNetwork->setName('GitHub');
        $socialNetwork->setIcon('icon-github');

        $this->addReference('sn-github', $socialNetwork);

        $manager->persist($socialNetwork);

        // Insertamos otra red social:
        $socialNetwork = new SocialNetwork();

        $socialNetwork->setName('LinkedIn');
        $socialNetwork->setIcon('icon-linkedin');

        $this->addReference('sn-linkedin', $socialNetwork);

        $manager->persist($socialNetwork);

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
