<?php

namespace My\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * My\FrontendBundle\Entity\Kontynent
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Kontynent
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
     * @var string $nazwa
     *
     * @ORM\Column(name="nazwa", type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\OneToMany(targetEntity="Panstwo", mappedBy="kontynent")
     */
    protected $panstwa;

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
     * Set nazwa
     *
     * @param string $nazwa
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getNazwa();
    }

    public function __construct()
    {
        $this->panstwa = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add panstwa
     *
     * @param My\FrontendBundle\Entity\Panstwo $panstwa
     */
    public function addPanstwo(\My\FrontendBundle\Entity\Panstwo $panstwa)
    {
        $this->panstwa[] = $panstwa;
    }

    /**
     * Get panstwa
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPanstwa()
    {
        return $this->panstwa;
    }
}