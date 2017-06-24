<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Project
 *
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class Project extends BaseEntity
{

    const _CLASS = 'AppBundle\Entity\Project';

    /**
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="project")
     */
    private $employees;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable= true)
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     */
    private $details;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->setEnabled(true);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getProject();
    }

    /**
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param string $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }





    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }


    /**
     * Add employee
     *
     * @param \AppBundle\Entity\Employee $employee
     *
     * @return Npc
     */
    public function addEmployee(\AppBundle\Entity\Employee $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee
     *
     * @param \AppBundle\Entity\Employee $employee
     */
    public function removeEmployee(\AppBundle\Entity\Employee $employee)
    {
        $this->employees->removeElement($employee);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }



}
