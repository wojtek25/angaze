<?php

namespace Gajdaw\AngazeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Department
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Department
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=false, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Faculty", inversedBy="department")
     */
    protected $faculty;

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
     * @return Department
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set faculty
     *
     * @param \Gajdaw\AngazeBundle\Entity\Faculty $faculty
     * @return Department
     */
    public function setFaculty(\Gajdaw\AngazeBundle\Entity\Faculty $faculty = null)
    {
        $this->faculty = $faculty;
    
        return $this;
    }

    /**
     * Get faculty
     *
     * @return \Gajdaw\AngazeBundle\Entity\Faculty 
     */
    public function getFaculty()
    {
        return $this->faculty;
    }
}