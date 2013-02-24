<?php

namespace Jm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LeadHistory
 *
 * @ORM\Table
 * @ORM\Entity
 */
class ProspectHistory
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
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="contactedBy", type="string", length=100)
     */
    private $contactedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set date
     *
     * @param \DateTime $date
     * @return ProspectHistory
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return ProspectHistory
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contactedBy
     *
     * @param string $contactedBy
     * @return ProspectHistory
     */
    public function setContactedBy($contactedBy)
    {
        $this->contactedBy = $contactedBy;
    
        return $this;
    }

    /**
     * Get contactedBy
     *
     * @return string 
     */
    public function getContactedBy()
    {
        return $this->contactedBy;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ProspectHistory
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
