<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service, establece los servicios para el curriculum, así como su dominio en los mismos.
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Service
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
     * @ORM\ManyToOne(targetEntity="Web\MainBundle\Entity\Curriculum", inversedBy="services")
     * @ORM\JoinColumn(name="curriculum_id", referencedColumnName="id")
     */
    protected $curriculumId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=50)
     */
    private $icon;

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
     * @return Service
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
     * Set description
     *
     * @param string $description
     *
     * @return Service
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
     * Set icon
     *
     * @param string $icon
     *
     * @return Service
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set curriculumId
     *
     * @param \Web\MainBundle\Entity\Curriculum $curriculumId
     *
     * @return Service
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
