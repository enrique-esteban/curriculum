<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EducationPlace, establece los títulos y cursos para el corriculum.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class EducationPlace
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
     * @ORM\ManyToOne(targetEntity="Web\MainBundle\Entity\Curriculum", inversedBy="education")
     * @ORM\JoinColumn(name="curriculum_id", referencedColumnName="id")
     */
    protected $curriculumId;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=100)
     */
    private $place;

    /**
     * @ORM\Column(name="titration", type="string", length=100)
     */
    protected $titration;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_course", type="boolean")
     */
    private $isCourse;

    /**
     * @var integer
     *
     * @ORM\Column(name="hours", type="integer")
     */
    private $hours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finish_date", type="datetime")
     */
    private $finishDate;

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
     * Set place
     *
     * @param string $place
     *
     * @return EducationPlace
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set titration
     *
     * @param string $titration
     *
     * @return EducationPlace
     */
    public function setTitration($titration)
    {
        $this->titration = $titration;

        return $this;
    }

    /**
     * Get titration
     *
     * @return string
     */
    public function getTitration()
    {
        return $this->titration;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return EducationPlace
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return EducationPlace
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
     * Set isCourse
     *
     * @param boolean $isCourse
     *
     * @return EducationPlace
     */
    public function setIsCourse($isCourse)
    {
        $this->isCourse = $isCourse;

        return $this;
    }

    /**
     * Get isCourse
     *
     * @return boolean
     */
    public function getIsCourse()
    {
        return $this->isCourse;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     *
     * @return EducationPlace
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return integer
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return EducationPlace
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set finishDate
     *
     * @param \DateTime $finishDate
     *
     * @return EducationPlace
     */
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * Get finishDate
     *
     * @return \DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * Set curriculumId
     *
     * @param \Web\MainBundle\Entity\Curriculum $curriculumId
     *
     * @return EducationPlace
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
}
