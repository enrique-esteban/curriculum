<?php

namespace Web\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User_SocialNetwork, establece las realacion usuarios con redes sociales incluyendo el campo propio url. 
 *
 * @ORM\Table(name="User_SocialNetwork", uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", columns={"user_id", "socialnetwork_id"})})
 * @ORM\Entity()
 */
class UserSocialNetwork
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
     * @ORM\ManyToOne(targetEntity="Web\UserBundle\Entity\User", inversedBy="socialNetworks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $userId;

     /**
     * @ORM\ManyToOne(targetEntity="Web\UserBundle\Entity\SocialNetwork", inversedBy="socialNetworks")
     * @ORM\JoinColumn(name="socialnetwork_id", referencedColumnName="id")
     */
    protected $snId;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

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
     * Set url
     *
     * @param string $url
     *
     * @return UserSocialNetwork
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set userId
     *
     * @param \Web\UserBundle\Entity\User $userId
     *
     * @return UserSocialNetwork
     */
    public function setUserId(\Web\UserBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Web\UserBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set snId
     *
     * @param \Web\UserBundle\Entity\SocialNetwork $snId
     *
     * @return UserSocialNetwork
     */
    public function setSnId(\Web\UserBundle\Entity\SocialNetwork $snId = null)
    {
        $this->snId = $snId;

        return $this;
    }

    /**
     * Get snId
     *
     * @return \Web\UserBundle\Entity\SocialNetwork
     */
    public function getSnId()
    {
        return $this->snId;
    }
}
