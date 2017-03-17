<?php
namespace Web\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Web\MainBundle\Entity\ContactMail;
use Web\MainBundle\Entity\Curriculum;
use Web\MainBundle\Entity\EducationPlace;
use Web\MainBundle\Entity\Language;
use Web\MainBundle\Entity\ProfessionalSkill;
use Web\MainBundle\Entity\WorkExperience;
use Web\UserBundle\Entity\User;

/**
 * Controlador principal del proyecto.
 *
 * @author Enrique José Esteban Plaza <ense.esteban@gmail.com>
 */
class SiteController extends Controller
{
	/**
	 * Carga la portada de la web
	 *
	 * Route("/", name="main_homepage")  /
	 * Template("MainBundle:Layout:index.html.twig")
	 */
	public function indexAction()
    {
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByUsernameWithSocialNetworks('enrique');

        $curriculum = $this->getDoctrine()->getRepository('MainBundle:Curriculum')->findOneByOwner($user);
        
        $professionalSkillGroups = $this->getDoctrine()->getRepository('MainBundle:ProfessionalSkillGroup')->findByCurriculum($curriculum->getId());
        
        $workExperiences = $this->getDoctrine()->getRepository('MainBundle:WorkExperience')->findBy(
        	array('curriculumId' => $curriculum->getId()),
        	array('startDate' => 'DESC')
        );

        $educationPlaces = $this->getDoctrine()->getRepository('MainBundle:EducationPlace')->findBy(
            array(
                'curriculumId' => $curriculum->getId(),
                'isCourse' => false
            ),
            array('startDate' => 'DESC')
        );

        $courses = $this->getDoctrine()->getRepository('MainBundle:EducationPlace')->findBy(
            array(
                'curriculumId' => $curriculum->getId(),
                'isCourse' => true
            ),
            array('startDate' => 'DESC')
        );
        
        $services = $this->getDoctrine()->getRepository('MainBundle:Service')->findByCurriculumId($curriculum->getId());

        // Comprobamos que todos los datos obtenidos de la base de datos existan
        if (!$user) {
        	throw $this->createNotFoundException('Unable to find User post.');
        } elseif (!$curriculum) {
        	throw $this->createNotFoundException('Unable to find Curriculum post.');
        } elseif (!$professionalSkillGroups) {
        	throw $this->createNotFoundException('Unable to find Professional Skill Groups post.');
        } elseif (!$workExperiences) {
        	throw $this->createNotFoundException('Unable to find Work Experiencies post.');
        } elseif (!$educationPlaces) {
        	throw $this->createNotFoundException('Unable to find Education Place post.');
        } elseif (!$courses) {
        	throw $this->createNotFoundException('Unable to find Courses post.');
        } elseif (!$services) {
        	throw $this->createNotFoundException('Unable to find Service post.');
        }

		return $this->render('MainBundle:Layout:index.html.twig', array(
                'user' => $user,
                'curriculum' => $curriculum,
                'professionalSkillGroups' => $professionalSkillGroups,
                'workExperiences' => $workExperiences,
                'educationPlaces' => $educationPlaces,
                'courses' => $courses,
                'services' => $services,
            )
        );
    }

	/**
	 * Carga y procesa el formulario de contacto
	 *
	 * Route("/site/contact/", name="contact_form")
	 * Tamplate("MainBundle:Static:contact.html.twig")
	 */
	public function contactAction()
	{
        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByUsernameWithSocialNetworks('enrique');

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User post.');
        }

		$request = $this->getRequest();

		$mail = new ContactMail();

        // Para los email de la sección contacto vamos a crear un formulario in-situ
		$form = $this->createFormBuilder($mail)
			->add('name', 'text', array(
					'label' => false,
					'max_length' => '50',
                    'attr' => array(
                        'placeholder' => 'Nombre'
                    )
				)
			)
			->add('email', 'email', array(
                    'label' => false,
					'max_length' => '100',
                    'attr' => array(
                        'placeholder' => 'Tú dirección de eMail'
                    )
				)
			)
	        ->add('subject', 'text', array(
	        		'label' => false,
	        		'max_length' => '50',
                    'attr' => array(
                        'placeholder' => 'Asunto'
                    )
	        	)
	        )
			->add('body', 'textarea', array(
					'label' => false,
					'max_length' => '255',
                    'attr' => array(
                        'placeholder' => 'Mensaje',
                        'rows' => '10'
                    )
	        	)
	        )
			->add('submit', 'submit', array(
					'label' => 'Envía tú eMail',
                    'attr' => array(
                        'class' => 'but opc-2'
                    )
                )
	        )
			->getForm();

		$form->handleRequest($request);

        if ($form->isValid()) {
        	$message = \Swift_Message::newInstance()
	        	->setSubject($mail->getSubject())
	            ->setFrom($mail->getEmail())
	            ->setTo($this->container->getParameter('emails.contact_email'))
	        	->setBody($this->renderView('MainBundle:Static:contact_mail.txt.twig', array('mail' => $mail)), 'text/html');

			$this->get('mailer')->send($message);
        	
        	$mail->setDate(new \DateTime());

        	// Las siguientes lineas de código guardaran una copia en la base de datos, en caso de que hallan sido mapeadas
        	// $em = $this->getDoctrine()->getManager();
 		    // $em->persist($mail);
  		    // $em->flush();

			$this->get('session')->getflashbag()->add('notice', 'El mensage se ha enviado correctamente.');

  		    return $this->redirect($this->generateUrl('contact_form'));
        }
    	
        return $this->render('MainBundle:Static:contact.html.twig', array(
                'user' => $user,
                'form' => $form->createView()
            )
        );
	}

	/**
	 * Carga el tamplate de una página estatica (ej: /about/, /info/)
	 *
	 * Route("/site/{page}", name="static_page")
	 * Tamplate("MainBundle:Static:'.$page.'.html.twig", vars={"page"})
	 *
	 * @param string $page slug del site a cargar
	 */
	public function staticAction($page)
	{
	    return $this->render('MainBundle:Static:'.$page.'.html.twig');
	}

	/**
	 * Route("/test/", name="test")
	 * Template("MainBundle:test.html.twig")
	 */
	public function testAction($var = "")
	{
	    return $this->render('MainBundle:Static:test.html.twig', array('var' => $var));
	}
}