<?php

namespace Web\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Interfaz necesariar para "transformar" la entidad en un proveedor de usuarios
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

// Paquete base para los validadores
use Symfony\Component\Validator\Constraints as Assert;

// La clase ArrayCollection, que envuelte un array de Php, se usa para alojar collecciones de
//    objetos para las relaciones 1..n.
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Web\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements AdvancedUserInterface
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\Length(min = 6)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

     /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", length=9, nullable=true)
     * @Assert\Length(min = 9, max = 9)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=100, nullable=true)
     */
    private $nationality;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_spam", type="boolean")
     */
    private $allowSpam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     */
    private $birthday;

    /**
     * @ORM\Column(name="image", type="string")
     *
     * @Assert\Image(maxSize = "500000", allowLandscape = false)
     */
    protected $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activated", type="boolean")
     */
    private $activated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="admin", type="boolean")
     */
    private $admin;

    /**
     * @ORM\OneToMany(targetEntity="\Web\BlogBundle\Entity\Post", mappedBy="author")
     */
    protected $post;

    /**
     * @ORM\OneToMany(targetEntity="\Web\BlogBundle\Entity\Comment", mappedBy="author")
     */
    protected $comments;

    /**
     * @ORM\OneToOne(targetEntity="\Web\MainBundle\Entity\Curriculum", mappedBy="owner")
     */
    protected $curriculum;

    /**
     * @ORM\OneToMany(targetEntity="\Web\UserBundle\Entity\UserSocialNetwork", mappedBy="userId")
     */
    protected $socialNetworks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->curriculums = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
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
     * Set nationality
     *
     * @param string $nationality
     *
     * @return User
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set allowSpam
     *
     * @param boolean $allowSpam
     *
     * @return User
     */
    public function setAllowSpam($allowSpam)
    {
        $this->allowSpam = $allowSpam;

        return $this;
    }

    /**
     * Get allowSpam
     *
     * @return boolean
     */
    public function getAllowSpam()
    {
        return $this->allowSpam;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     *
     * @return User
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Set admin
     *
     * @param boolean $admin
     *
     * @return User
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Add post
     *
     * @param \Web\BlogBundle\Entity\Post $post
     *
     * @return User
     */
    public function addBlog(\Web\BlogBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Web\BlogBundle\Entity\Post $post
     */
    public function removeBlog(\Web\BlogBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogs()
    {
        return $this->posts;
    }

    /**
     * Add comment
     *
     * @param \Web\BlogBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\Web\BlogBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Web\BlogBundle\Entity\Comment $comment
     */
    public function removeComment(\Web\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add socialNetworks
     *
     * @param \Web\UserBundle\Entity\UserSocialNetwork $socialNetworks
     *
     * @return User
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

    /**
     * Set curriculum
     *
     * @param \Web\MainBundle\Entity\Curriculum $curriculum
     *
     * @return User
     */
    public function setCurriculum(\Web\MainBundle\Entity\Curriculum $curriculum = null)
    {
        $this->curriculum = $curriculum;

        return $this;
    }

    /**
     * Get curriculum
     *
     * @return \Web\MainBundle\Entity\Curriculum
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }

    /**
     * Add socialNetwork
     *
     * @param \Web\UserBundle\Entity\UserSocialNetwork $socialNetwork
     *
     * @return User
     */
    public function addSocialNetwork(\Web\UserBundle\Entity\UserSocialNetwork $socialNetwork)
    {
        $this->socialNetworks[] = $socialNetwork;

        return $this;
    }

    /**
     * Remove socialNetwork
     *
     * @param \Web\UserBundle\Entity\UserSocialNetwork $socialNetwork
     */
    public function removeSocialNetwork(\Web\UserBundle\Entity\UserSocialNetwork $socialNetwork)
    {
        $this->socialNetworks->removeElement($socialNetwork);
    }

    /**********************************************************************************************
     Inicio de la interfaz "Symfony\Component\Security\Core\User\(Advanced)UserInterface" */

    // Nota: getUsername(), getPassword() y getSalt(), necesarios para la interfaz, están
    //    implementados más arriba.
     
    /** 
     * Borra los datos sensibles del usuario en caso de que sea necesarios
     *
     * @return boolean 
     */
    function eraseCredentials() {
        return true;
    }

    /**
     * Obtiene el Role del usuario
     *
     * @return array 
     */
    function getRoles()
    {
        if ($this->getAdmin()) {
            return array('ROLE_ADMIN');
        }
        return array('ROLE_USER');
    }

    /** 
     * Comprueba que la cuenta del usuario no ha expirado devuelve true si no lo está (AdvancedUserIntarface)
     *
     * @return boolean 
     */
    function isAccountNonExpired() {
        return true;
    }
    
    /** 
     * Comprueba si el usuario está bloqueado, devuelve true si no lo está (AdvancedUserIntarface)
     *
     * @return boolean 
     */
    function isAccountNonLocked() {
        return true;
    }
    
    /**
     * Comprueba si las credenciales del usuario han expìrado, devuelve true si no lo está (AdvancedUserIntarface)
     *
     * @return boolean 
     */
    function isCredentialsNonExpired() {
        return true;
    }

    /**
     * Comprueba si el usuario está activo, devuelve true si no lo está (AdvancedUserIntarface)
     *
     * @return boolean 
     */
    function isEnabled()
    {
        return $this->getActivated();
    }
    /* Fin de la interfaz "Symfony\Component\Security\Core\User\(Advanced)UserInterface"
    **********************************************************************************************/

    /**
     * Se establece unos valores por defecto para la creación de la tabla en la BD
     * 
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = new \DateTime('now');
        
        // Este atributo será estrictamente false, se cambiará a true cuando el usuario que creo
        //    la cuenta valide dicho usuario mediente un correo electrónico. 
        if (null === $this->getActivated()) $this->activated = false;
        
        // Estos atributos tomaran el valor por defecto en caso de que se hallan omintido
        if (null === $this->getImage()) $this->image = '/images/profiles/default.jpg';
        if (null === $this->getAdmin()) $this->admin = false;
    }

    /**
     * Devuelve el "nombre" de la entidad, que corresponde al firtname si existe, si no devuelve
     *    el username
     *
     * @return string
     */
    public function __toString() {
        if ($this->getFirstName()) {
            return $this->firstName;
        }

        return $this->username;
    }
}