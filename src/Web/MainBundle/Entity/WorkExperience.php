<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkExperience, establece la experiencia laboral para el corriculum.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class WorkExperience
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
     * @ORM\ManyToOne(targetEntity="Web\MainBundle\Entity\Curriculum", inversedBy="workExperiences")
     * @ORM\JoinColumn(name="curriculum_id", referencedColumnName="id")
     */
    protected $curriculumId;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=100)
     */
    private $company;

    /**
     * @ORM\Column(name="job_title", type="string", length=100)
     */
    protected $jobTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finish_date", type="datetime", nullable=true)
     */
    private $finishDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_years", type="integer", nullable=true)
     */
    private $numberOfYears;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_current", type="boolean")
     */
    private $isCurrent;

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
     * Set company
     *
     * @param string $company
     *
     * @return WorkExperience
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     *
     * @return WorkExperience
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return WorkExperience
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return WorkExperience
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
     * @return WorkExperience
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
     * Set numberOfYears
     *
     * @param integer $numberOfYears
     *
     * @return WorkExperience
     */
    public function setNumberOfYears($numberOfYears)
    {
        $this->numberOfYears = $numberOfYears;

        return $this;
    }

    /**
     * Get numberOfYears
     *
     * @return integer
     */
    public function getNumberOfYears()
    {
        return $this->numberOfYears;
    }

    /**
     * Set curriculumId
     *
     * @param \Web\MainBundle\Entity\Curriculum $curriculumId
     *
     * @return WorkExperience
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
     * Set isCurrent
     *
     * @param boolean $isCurrent
     *
     * @return WorkExperience
     */
    public function setIsCurrent($isCurrent)
    {
        $this->isCurrent = $isCurrent;

        return $this;
    }

    /**
     * Get isCurrent
     *
     * @return boolean
     */
    public function getIsCurrent()
    {
        return $this->isCurrent;
    }
}
