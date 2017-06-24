<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Fresh\VichUploaderSerializationBundle\Annotation as Fresh;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Employee
 *
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 *
 * @Vich\Uploadable
 * @Fresh\VichSerializableClass
 */
class Employee extends BaseEntity
{
    const _CLASS = 'AppBundle\Entity\Employee';


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     */
    private $employee;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project", inversedBy="employees")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
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
    private $address;


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\Type(
     *     type="digit",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     */
    private $phone;


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     */
    private $position;


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     */
    private $nationality;


    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @JMS\Expose
     * @JMS\Type("string")
     * @JMS\Groups({"list"})
     *
     * @JMS\Accessor(getter="getImageUrl")
     */
    private $image;

    /**
     * @var File
     *
     * @Vich\UploadableField(fileNameProperty="image", mapping="media")
     *
     */
    private $imageFile;



    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->setEnabled(true);
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getEmployee();
    }


    /**
     * @return string
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param string $employee
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }


    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }


    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Employee
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getproject_id()
    {
        return $this->project;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }


//    /**
//     * @param File $image
//     */
//    public function setImageFile(File $image = null)
//    {
//        $this->imageFile = $image;
//    }
//
//    /**
//     * @return File
//     */
//    public function getImageFile()
//    {
//        return $this->imageFile;
//    }
//
//    /**
//     * @param string $image
//     */
//    public function setImage($image)
//    {
//        $this->image = $image;
//    }
//
//    /**
//     * @return string
//     */
//    public function getImage()
//    {
//        return $this->image;
//    }



}
