<?php

namespace My\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * My\FrontendBundle\Entity\Panstwo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Panstwo
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
     * @ORM\ManyToOne(targetEntity="Kontynent", inversedBy="panstwa")
     */
    protected $kontynent;

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
        return $this->getNazwa();
    }


    /**
     * Set kontynent
     *
     * @param My\FrontendBundle\Entity\Kontynent $kontynent
     */
    public function setKontynent(\My\FrontendBundle\Entity\Kontynent $kontynent)
    {
        $this->kontynent = $kontynent;
    }

    /**
     * Get kontynent
     *
     * @return My\FrontendBundle\Entity\Kontynent 
     */
    public function getKontynent()
    {
        return $this->kontynent;
    }
}