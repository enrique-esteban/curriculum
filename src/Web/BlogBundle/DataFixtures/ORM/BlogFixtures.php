<?php
 
namespace Web\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Web\BlogBundle\Entity\Blog;


/**
 * Datos de prueba para la entidad Blog
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>  
 */
class LoadBlogData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 5; $i++) { 
            $blog = new Blog();

            // Se establece los valores (para las fechas se toma los valores por defecto, ver contructor de la entidad)
            $blog->setTitle('Example'.$i);
            $blog->setSlug('example'.$i);
            $blog->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
            $blog->setAuthor($this->getReference('user'.mt_rand(1,5)));
            
            // A cada blog se le asignará 5 tags aleatorios, como el nombre de los tags corresponde
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
                $blog->addTag($this->getReference('tag'.$tag_number));
            }

            $manager->persist($blog);

            $this->addReference('blog'.$i,$blog);
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