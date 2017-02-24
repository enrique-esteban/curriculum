<?php
 
namespace Web\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Web\UserBundle\Entity\UserSocialNetwork;


/**
 * Datos de prueba para la entidad UserSocialNetwork
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class LoadUserSocialNetworkData extends AbstractFixture implements OrderedFixtureInterface
{    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Insertamos una red social:
        $userSocialNetwork = new UserSocialNetwork();

        $userSocialNetwork->setSnId($this->getReference('sn-facebook'));
        $userSocialNetwork->setUserId($this->getReference('user_curriculum'));
        $userSocialNetwork->setUrl('https://www.facebook.com/ense.esteban');

        $manager->persist($userSocialNetwork);

        // Insertamos otra red social:
        $userSocialNetwork = new UserSocialNetwork();
        
        $userSocialNetwork->setSnId($this->getReference('sn-twitter'));
        $userSocialNetwork->setUserId($this->getReference('user_curriculum'));
        $userSocialNetwork->setUrl('https://twitter.com/enr_esteban');

        $manager->persist($userSocialNetwork);
        
        // Insertamos otra red social:
        $userSocialNetwork = new UserSocialNetwork();
        
        $userSocialNetwork->setSnId($this->getReference('sn-github'));
        $userSocialNetwork->setUserId($this->getReference('user_curriculum'));
        $userSocialNetwork->setUrl('https://github.com/enrique-esteban');

        $manager->persist($userSocialNetwork);
        
        // Insertamos otra red social:
        $userSocialNetwork = new UserSocialNetwork();
        
        $userSocialNetwork->setSnId($this->getReference('sn-linkedin'));
        $userSocialNetwork->setUserId($this->getReference('user_curriculum'));
        $userSocialNetwork->setUrl('https://www.linkedin.com/in/enrique-esteban-plaza-77487070/');

        $manager->persist($userSocialNetwork);

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
