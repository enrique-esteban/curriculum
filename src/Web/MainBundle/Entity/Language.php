<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language, establece las idiomas para el curriculum, así como su dominio en los mismos.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Language
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
     * @ORM\ManyToOne(targetEntity="Web\MainBundle\Entity\Curriculum", inversedBy="languages")
     * @ORM\JoinColumn(name="curriculum_id", referencedColumnName="id")
     */
    protected $curriculumId;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=100)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="proficiency", type="string", length=50)
     */
    private $proficiency;

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
     * Set language
     *
     * @param string $language
     *
     * @return Language
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set proficiency
     *
     * @param string $proficiency
     *
     * @return Language
     */
    public function setProficiency($proficiency)
    {
        $this->proficiency = $proficiency;

        return $this;
    }

    /**
     * Get proficiency
     *
     * @return string
     */
    public function getProficiency()
    {
        return $this->proficiency;
    }

    /**
     * Set curriculumId
     *
     * @param \Web\MainBundle\Entity\Curriculum $curriculumId
     *
     * @return Language
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
