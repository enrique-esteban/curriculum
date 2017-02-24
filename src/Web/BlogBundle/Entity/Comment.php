<?php

namespace Web\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad que representa los comentarios asociados a cada blog
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Web\BlogBundle\Entity\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Web\UserBundle\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     */
    protected $author;

    /**
     * @ORM\Column(name="body", type="text", length=200)
     */
    protected $body;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $approved;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="comments")
     * @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
     */
    protected $blog;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

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
     * Set body
     *
     * @param string $body
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return Comment
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Comment
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Comment
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set author
     *
     * @param \Web\UserBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\Web\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Web\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set blog
     *
     * @param \Web\BlogBundle\Entity\Blog $blog
     * @return Comment
     */
    public function setBlog(\Web\BlogBundle\Entity\Blog $blog = null)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return \Web\BlogBundle\Entity\Blog 
     */
    public function getBlog()
    {
        return $this->blog;
    }

    // Ciclo de vida (HasLifecycleCallbacks):
    
    /**
     * SE establece unos valores por defecto en la creación de la entidad
     * 
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');

        // Por defecto, y dado que es una aplicación de preubas, todos los comentarios se consideran aprovados.
        $this->approved = true;
    }
}