<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curriculum
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Web\MainBundle\Entity\CurriculumRepository")
 */
class Curriculum
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
     * @ORM\OneToOne(targetEntity="Web\UserBundle\Entity\User", inversedBy="curriculum")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="career", type="string", length=100)
     */
    private $career;

    /**
     * @var string
     *
     * @ORM\Column(name="skype_username", type="string", length=100)
     */
    private $skypeUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * Tabla de habilidades profesionales
     *
     * @ORM\OneToMany(targetEntity="ProfessionalSkill", mappedBy="curriculumId")
     */
    protected $professionalSkills;

    /**
     * Tabla de experiencias laborales
     * 
     * @ORM\OneToMany(targetEntity="WorkExperience", mappedBy="curriculumId")
     */
    protected $workExperiences;

    /**
     * Tabla de estudios
     * 
     * @ORM\OneToMany(targetEntity="EducationPlace", mappedBy="curriculumId")
     */
    protected $education;

    /**
     * Tabla de Idiomas
     * 
     * @ORM\OneToMany(targetEntity="Language", mappedBy="curriculumId")
     */
    protected $languages;

    /**
     * Tabla de Servicios
     * 
     * @ORM\OneToMany(targetEntity="Service", mappedBy="curriculumId")
     */
    protected $services;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->professionalSkills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->workExperiences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->education = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set career
     *
     * @param string $career
     *
     * @return Curriculum
     */
    public function setCareer($career)
    {
        $this->career = $career;

        return $this;
    }

    /**
     * Get career
     *
     * @return string
     */
    public function getCareer()
    {
        return $this->career;
    }

    /**
     * Set skypeUsername
     *
     * @param string $skypeUsername
     *
     * @return Curriculum
     */
    public function setSkypeUsername($skypeUsername)
    {
        $this->skypeUsername = $skypeUsername;

        return $this;
    }

    /**
     * Get skypeUsername
     *
     * @return string
     */
    public function getSkypeUsername()
    {
        return $this->skypeUsername;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Curriculum
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set owner
     *
     * @param \Web\UserBundle\Entity\User $owner
     *
     * @return Curriculum
     */
    public function setOwner(\Web\UserBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \Web\UserBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add professionalSkill
     *
     * @param \Web\MainBundle\Entity\ProfessionalSkill $professionalSkill
     *
     * @return Curriculum
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

    /**
     * Add workExperience
     *
     * @param \Web\MainBundle\Entity\WorkExperience $workExperience
     *
     * @return Curriculum
     */
    public function addWorkExperience(\Web\MainBundle\Entity\WorkExperience $workExperience)
    {
        $this->workExperiences[] = $workExperience;

        return $this;
    }

    /**
     * Remove workExperience
     *
     * @param \Web\MainBundle\Entity\WorkExperience $workExperience
     */
    public function removeWorkExperience(\Web\MainBundle\Entity\WorkExperience $workExperience)
    {
        $this->workExperiences->removeElement($workExperience);
    }

    /**
     * Get workExperiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkExperiences()
    {
        return $this->workExperiences;
    }

    /**
     * Add education
     *
     * @param \Web\MainBundle\Entity\EducationPlace $education
     *
     * @return Curriculum
     */
    public function addEducation(\Web\MainBundle\Entity\EducationPlace $education)
    {
        $this->education[] = $education;

        return $this;
    }

    /**
     * Remove education
     *
     * @param \Web\MainBundle\Entity\EducationPlace $education
     */
    public function removeEducation(\Web\MainBundle\Entity\EducationPlace $education)
    {
        $this->education->removeElement($education);
    }

    /**
     * Get education
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Add language
     *
     * @param \Web\MainBundle\Entity\Language $language
     *
     * @return Curriculum
     */
    public function addLanguage(\Web\MainBundle\Entity\Language $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \Web\MainBundle\Entity\Language $language
     */
    public function removeLanguage(\Web\MainBundle\Entity\Language $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Add service
     *
     * @param \Web\MainBundle\Entity\Service $service
     *
     * @return Curriculum
     */
    public function addService(\Web\MainBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Web\MainBundle\Entity\Service $service
     */
    public function removeService(\Web\MainBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}
