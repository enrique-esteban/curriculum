<?php
 
namespace Web\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Web\BlogBundle\Entity\Post;


/**
 * Datos de prueba para la entidad Post
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>  
 */
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 5; $i++) { 
            $post = new Post();

            // Se establece los valores (para las fechas se toma los valores por defecto, ver contructor de la entidad)
            $post->setTitle('Example'.$i);
            $post->setSlug('example'.$i);
            $post->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
            $post->setAuthor($this->getReference('user'.mt_rand(1,5)));
            
            // Generamos una fecha de actualización aleatoria
            $date = mt_rand(1,28).'-'.mt_rand(1,12).'-'.mt_rand(2010,2017);
            $post->setUpdated(new \DateTime($date));

            // A cada post se le asignará 5 tags aleatorios, como el nombre de los tags corresponde
            //    con el patrón tag[1-10], para ello obtenemos 5 núrmeros aleatorios, distintos,
            //    entre 1 y 10
            $tag_numbers = Array();
            $tag_numbers[] = mt_rand(1,10); // Añadimos el primer número
            
            for ($j=1; $j < 5; $j++) { // Se obtiene otros 4 números más, comprobando que todos sean distintos
                $tag_numbers[$j] = mt_rand(1,10);

                for ($k=0; $k < $j; $k++) { 
                    if($tag_numbers[$j] == $tag_numbers[$k]) {
                        $j--;
                        break;
                    }
                }
            }

            foreach ($tag_numbers as $tag_number) { // Finalmente se guardan los tags
                $post->addTag($this->getReference('tag'.$tag_number));
            }

            $manager->persist($post);

            $this->addReference('post'.$i,$post);
        }

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