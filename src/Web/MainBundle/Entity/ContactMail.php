<?php

namespace Web\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Paquete base para los validadores:
use Symfony\Component\Validator\Constraints as Assert;


class ContactMail
{
    private $id;

    protected $name;

    protected $email;

    protected $subject;

    protected $body;

    protected $date;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }
}