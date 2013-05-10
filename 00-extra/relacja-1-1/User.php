<?php

namespace My\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * My\FrontendBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     *
     * @ORM\OneToOne(targetEntity="Profil")
     */
     private $profil;


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
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set profil
     *
     * @param My\FrontendBundle\Entity\Profil $profil
     */
    public function setProfil(\My\FrontendBundle\Entity\Profil $profil)
    {
        $this->profil = $profil;
    }

    /**
     * Get profil
     *
     * @return My\FrontendBundle\Entity\Profil 
     */
    public function getProfil()
    {
        return $this->profil;
    }
}