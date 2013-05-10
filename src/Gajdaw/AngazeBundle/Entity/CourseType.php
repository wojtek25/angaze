<?php

namespace Gajdaw\AngazeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CourseType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CourseType
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
     * @ORM\OneToMany(targetEntity="Course", mappedBy="courseType")
     */
    protected $course;

    /**
     * @var string
     *
     * @ORM\Column(name="tmp", type="string", length=255)
     */

    private $tmp;

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
     * @return CourseType
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
     * Set tmp
     *
     * @param string $tmp
     * @return Course
     */
    public function setTmp($tmp)
    {
        $this->tmp = $tmp;

        return $this;
    }

    /**
     * Get tmp
     *
     * @return string
     */
    public function getTmp()
    {
        return $this->tmp;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add course
     *
     * @param \Gajdaw\AngazeBundle\Entity\Course $course
     * @return CourseType
     */
    public function addCourse(\Gajdaw\AngazeBundle\Entity\Course $course)
    {
        $this->course[] = $course;
    
        return $this;
    }

    /**
     * Remove course
     *
     * @param \Gajdaw\AngazeBundle\Entity\Course $course
     */
    public function removeCourse(\Gajdaw\AngazeBundle\Entity\Course $course)
    {
        $this->course->removeElement($course);
    }

    /**
     * Get course
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourse()
    {
        return $this->course;
    }
}