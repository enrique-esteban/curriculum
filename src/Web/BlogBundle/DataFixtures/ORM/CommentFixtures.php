<?php
 
namespace Web\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Web\BlogBundle\Entity\Comment;


/**
 * Datos de prueba para la entidad Comment
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com> 
 */
class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.');
        $comment->setPost($this->getReference('post1'));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!');
        $comment->setPost($this->getReference('post1'));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.');
        $comment->setPost($this->getReference('post2'));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Are you challenging me? ');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 06:15:20"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Name your stakes.');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 06:18:35"));
        $comment->setApproved(true);
        $manager->persist($comment);
        
        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('If I win, you become my slave.');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 06:22:53"));
        $comment->setApproved(true);
        $manager->persist($comment);
        
        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Your SLAVE?');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 06:25:15"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('You wish! You\'ll do shitwork, scan, crack copyrights...');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 06:46:08"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('And if I win?');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 10:22:46"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Make it my first-born!');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-23 11:08:08"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Make it our first-date!');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-24 18:56:01"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('I don\'t DO dates. But I don\'t lose either, so you\'re on!');
        $comment->setPost($this->getReference('post2'));
        $comment->setCreated(new \DateTime("2011-07-25 22:28:42"));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('It\'s not gonna end like this.');
        $comment->setPost($this->getReference('post3'));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.');
        $comment->setPost($this->getReference('post3'));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Doesn\'t Bill Gates have something like that?');
        $comment->setPost($this->getReference('post5'));
        $comment->setApproved(true);
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setAuthor($this->getReference('user'.rand(1,5)));
        $comment->setBody('Bill Who?');
        $comment->setPost($this->getReference('post5'));
        $comment->setApproved(true);
        $manager->persist($comment);

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