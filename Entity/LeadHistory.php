<?php

namespace Jm\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LeadHistory
 *
 * @ORM\Table
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class LeadHistory
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
      * @ORM\ManyToOne(targetEntity="Lead", cascade={"all"})
      */
    private $lead;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     * @Assert\Choice(callback = {"Jm\CrmBundle\Enum\ContactTypeEnum", "values"})
     */
    private $contactType;

    /**
     * @var string
     *
     * @ORM\Column(name="contacted_by", type="string", length=100)
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
     * @return LeadHistory
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
     * Set contactType
     *
     * @param string $type
     * @return LeadHistory
     */
    public function setContactType($contactType)
    {
        $this->contactType = $contactType;
        return $this;
    }

    /**
     * Get contactType
     *
     * @return string 
     */
    public function getContactType()
    {
        return $this->contactType;
    }

    /**
     * Set contactedBy
     *
     * @param string $contactedBy
     * @return LeadHistory
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
     * @return LeadHistory
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

    /**
     * Get Lead
     *
     * @return Lead
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * Set Lead
     *
     * @return LeadHistory
     */
    public function setLead($lead)
    {
        $this->lead = $lead;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function beforePersist()
    {
        $this->setDate(new \DateTime());
    }

    public function __toString()
    {
        return '';
        return $this->lead->getCompany();
    }
}
