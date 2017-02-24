<?php

namespace Web\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Web\BlogBundle\Entity\Blog;

/**
 * Controla las acciones principales de las etiquetas de los blogs.
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class TagController extends Controller
{

    /**
     * Calcuala la "relevancia" de una lista de tags, medida en el número de veces que se hace uso de cada tag (a mayor
     *     número de usos mayor relevancia). Luego se ajusta la "relevancia" para que esté comprendida entre 1 y 5, a
     *     nivel de diseño marcará el tamaño que tendrá el texto en la nube de tags.  
     * 
     * @param array $tags lista de los tags usados en cada blog
     * @param boolean $random indica si el array de retorno es ordenado de forma aleatoria, por defecto es no (false)
     *
     * @return array $relevanceOfTags array con la 'relevancia' obtenida de cada tag, su nombre y su slug
     */
    protected function getRelevanceOfTags($tags, $random = false)
    {
        // Calculo la importancia de cada etiqueta, contando el número de veces usada, finalmente genero un array
        //     bidimencial con el nombre, el slug y la relevancia de cada etiqueta
        foreach ($tags as $tag) {
            if (empty($relevanceOfTags [$tag->getId()])) {
                $relevanceOfTags [$tag->getId()] = array (
                    'amount' => 1,
                    'name' => $tag->getName(),
                    'slug' => $tag->getSlug()
                );
            }
            else {
                $relevanceOfTags [$tag->getId()]['amount'] ++;
            }
        }

        // A nivel de diseño se usarán 5 tamaños de texto para la nube de etiquetas, pero como el valor máximo para la
        //     relevancia de las etiquetas depende de su uso en los blogs su valor puede ser mayor que 5 así que se
        //     ajustará para que sus valores estén comprendidos entre 5 y 1
        // Nota: Los array son medido por sus valores, de izquierda a derecha, lso strings que no empiezen por número 
        //     vale 0, asi que, por ejemplo, el array (4, 'Tag1', 'tag1') equivale a (4, 0, 0) y es mayor que (2, 5, 0) 
        $maxRelevance = max($relevanceOfTags);

        if ($maxRelevance ['amount'] > 5) {
            foreach ($relevanceOfTags as &$relevanceOfTag) {
                $relevanceOfTag ['amount'] = ceil($relevanceOfTag ['amount']*5/$maxRelevance ['amount']);
            }
        }

        // Si $random es verdadero se desordena el array de forma aleatoria
        if ($random) {
            uksort(
                $relevanceOfTags,
                function() { return mt_rand(0,1); }
            );
        }

        return $relevanceOfTags;
    }

    /**
     * Busca todos los tags usados en los blogs y calcula su importancia (medido en veces de uso) para usarlo en una
     *     nube de tags que se colocará en la barra lateral (aside)
     * 
     * Template("BlogBundle:Tag:tag_cloud.html.twig", vars={"relevanceOfTags"})
     */
    public function tagCloudAction()
    {
        $em = $this->getDoctrine()->getManager();

        // Ultilizo el metodo findAllWithTags() que he definido para obtener los blogs que tengán relación con algún
        //     tag
        // Nota: Obtengo los tags también ya que es más eficiente que obtenerlos posteriormente mediante el lazy
        //     loading de Doctrine2  
        $blogs = $em->getRepository('BlogBundle:Blog')->findAllRelatingToTags();

        // Suponemos que puede no haber ningún blog, o ningún tag asignado a algún blog, por tanto $blogs estará vacía
        if (empty($blogs)) {
            return $this->render('BlogBundle:Tag:tag_cloud.html.twig', array('relevanceOfTags' => ''));
        }

        foreach ($blogs as $blog) {
            $blogsTagsList [] = $blog->getTags(); // Este array contiene varios ArrayCollection de objetos Tag
        }

        // Separo los objetos Tag para guardarlos en un array ($tags), para ello tengo que obtenerlos de cada objeto
        //     ArrayCollection del array $blogsTagsList
        foreach ($blogsTagsList as $blogTagsList) {
            foreach ($blogTagsList as $blogTag) {
                $tags [] = $blogTag;
            }
        }

        // Se obtiene la relevancia de los tags en un número de 1 al 5
        $relevanceOfTags = $this->getRelevanceOfTags($tags);

        return $this->render('BlogBundle:Tag:tag_cloud.html.twig', array('relevanceOfTags' => $relevanceOfTags));
    }
}
