<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfessionalSkill, establece las habilidades profesionales para el curriculum, expresadas por un pordentaje,
 *    por ejemplo: Photoshop(90%), Illustrater(80%), HTML/CSS(90%), etc.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ProfessionalSkill
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
     * @ORM\ManyToOne(targetEntity="Web\MainBundle\Entity\Curriculum", inversedBy="professionalSkills")
     * @ORM\JoinColumn(name="curriculum_id", referencedColumnName="id")
     */
    protected $curriculumId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

     /**
     * @ORM\ManyToOne(targetEntity="Web\MainBundle\Entity\ProfessionalSkillGroup", inversedBy="professionalSkills")
     * @ORM\JoinColumn(name="`group`", referencedColumnName="id")
     */
    protected $group;

    /**
     * @var integer
     *
     * @ORM\Column(name="percentage", type="integer")
     */
    private $percentage;

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
     * @return ProfessionalSkill
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
     * Set percentage
     *
     * @param integer $percentage
     *
     * @return ProfessionalSkill
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return integer
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set curriculumId
     *
     * @param \Web\MainBundle\Entity\Curriculum $curriculumId
     *
     * @return ProfessionalSkill
     */
    public function setCurriculumId(\Web\MainBundle\Entity\Curriculum $curriculumId = null)
    {
        $this->curriculumId = $curriculumId;

        return $this;
    }

    /**
     * Get curriculumId
     *
     * @return \Web\MainBundle\Entity\Curriculum
     */
    public function getCurriculumId()
    {
        return $this->curriculumId;
    }

    /**
     * Set group
     *
     * @param \Web\MainBundle\Entity\ProfessionalSkillGroup $group
     *
     * @return ProfessionalSkill
     */
    public function setGroup(\Web\MainBundle\Entity\ProfessionalSkillGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Web\MainBundle\Entity\ProfessionalSkillGroup
     */
    public function getGroup()
    {
        return $this->group;
    }
}
