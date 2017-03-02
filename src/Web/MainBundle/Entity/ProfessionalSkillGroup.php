<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfessionalSkillGroup, establece las grupos para habilidades personales (PersonalSkills), ordenadas
 *    por categoría, y expresadas por un pordentaje, por ejemplo: Diseño: Photoshop, illustrator; Desarrollo
 *    web: php, javascript; etc.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Web\MainBundle\Entity\ProfessionalSkillGroupRepository")
 */
class ProfessionalSkillGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\OneToMany(targetEntity="Web\MainBundle\Entity\ProfessionalSkill", mappedBy="group")
     */
    protected $professionalSkills;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

     /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="css_class", type="string", length=100)
     */
    private $cssClass;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->professionalSkills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProfessionalSkillGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return ProfessionalSkillGroup
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set cssClass
     *
     * @param string $cssClass
     *
     * @return ProfessionalSkillGroup
     */
    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    /**
     * Get cssClass
     *
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * Add professionalSkill
     *
     * @param \Web\MainBundle\Entity\ProfessionalSkill $professionalSkill
     *
     * @return ProfessionalSkillGroup
     */
    public function addProfessionalSkill(\Web\MainBundle\Entity\ProfessionalSkill $professionalSkill)
    {
        $this->professionalSkills[] = $professionalSkill;

        return $this;
    }

    /**
     * Remove professionalSkill
     *
     * @param \Web\MainBundle\Entity\ProfessionalSkill $professionalSkill
     */
    public function removeProfessionalSkill(\Web\MainBundle\Entity\ProfessionalSkill $professionalSkill)
    {
        $this->professionalSkills->removeElement($professionalSkill);
    }

    /**
     * Get professionalSkills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfessionalSkills()
    {
        return $this->professionalSkills;
    }
}
