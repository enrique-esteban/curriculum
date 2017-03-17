<?php

namespace Web\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialNetwork, establece las redes sociales ha incluir por los usuarios. 
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class SocialNetwork
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
     * @ORM\OneToMany(targetEntity="\Web\UserBundle\Entity\UserSocialNetwork", mappedBy="snId")
     */
    protected $socialNetworks;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=100)
     */
    private $icon;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->socialNetworks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SocialNetwork
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
     * Set icon
     *
     * @param string $icon
     *
     * @return SocialNetwork
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
     * Add socialNetworks
     *
     * @param \Web\UserBundle\Entity\UserSocialNetwork $socialNetworks
     *
     * @return SocialNetwork
     */
    public function addSocialNetworks(\Web\UserBundle\Entity\UserSocialNetwork $socialNetworks)
    {
        $this->socialNetworks[] = $socialNetworks;

        return $this;
    }

    /**
     * Remove socialNetworks
     *
     * @param \Web\UserBundle\Entity\UserSocialNetwork $socialNetworks
     */
    public function removeSocialNetworks(\Web\UserBundle\Entity\UserSocialNetwork $socialNetworks)
    {
        $this->socialNetworks->removeElement($socialNetworks);
    }

    /**
     * Get socialNetworks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSocialNetworks()
    {
        return $this->socialNetworks;
    }
}
