<?php

namespace Gajdaw\AngazeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Faculty
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Faculty
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
     * @ORM\OneToMany(targetEntity="department", mappedBy="faculty")
     */
    protected $department;

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
     * @return Faculty
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
     * Constructor
     */
    public function __construct()
    {
        $this->department = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add department
     *
     * @param \Gajdaw\AngazeBundle\Entity\department $department
     * @return Faculty
     */
    public function addDepartment(\Gajdaw\AngazeBundle\Entity\department $department)
    {
        $this->department[] = $department;
    
        return $this;
    }

    /**
     * Remove department
     *
     * @param \Gajdaw\AngazeBundle\Entity\department $department
     */
    public function removeDepartment(\Gajdaw\AngazeBundle\Entity\department $department)
    {
        $this->department->removeElement($department);
    }

    /**
     * Get department
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartment()
    {
        return $this->department;
    }
}