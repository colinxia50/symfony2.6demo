<?php

namespace Xcx\IstxtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Isdoc
 */
class Isdoc
{
    /**
     * @var integer
     */
    public $id;
    
    
    /**
     * @var integer
     */
    public $category_id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     * @Assert\length(min=3,max=120)
     */
    public $position;

    /**
     * @var string
     * @Assert\length(min=3,max=3000)
     */
    public $description;

    /**
     * @var boolean
     */
    public $is_public;

    /**
     * @var boolean
     */
    public $is_activated;

    /**
     * @var string
     */
    public $email;

    /**
     * @var \DateTime
     */
    public $expires_at;

    /**
     * @var \DateTime
     */
    public $created_at;

    /**
     * @var \DateTime
     */
    public $updated_at;

    /**
     * @var \Xcx\IstxtBundle\Entity\Category
     */
    public $category;


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
     * Set type
     *
     * @param string $type
     * @return Isdoc
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
     * Set company
     *
     * @param string $company
     * @return Isdoc
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Isdoc
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Isdoc
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
     * Set is_public
     *
     * @param boolean $isPublic
     * @return Isdoc
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
    
        return $this;
    }

    /**
     * Get is_public
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Isdoc
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;
    
        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Isdoc
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set category_id
     *
     * @param string $CategoryId
     * @return Isdoc
     */
    public function setCategoryId($CategoryId)
    {
        $this->category_id = $CategoryId;
    
        return $this;
    }
    
    /**
     * Get category_id
     *
     * @return string
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set expires_at
     *
     * @param \DateTime $expiresAt
     * @return Isdoc
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;
    
        return $this;
    }

    /**
     * Get expires_at
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Isdoc
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Isdoc
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set category
     *
     * @param \Xcx\IstxtBundle\Entity\Category $category
     * @return Isdoc
     */
    public function setCategory(\Xcx\IstxtBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Xcx\IstxtBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
        if(!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
        
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
        $this->updated_at = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiresAtValue()
    {
          if(!$this->getExpiresAt()) {
            $now = $this->getCreatedAt() ? $this->getCreatedAt()->format('U') : time();
            $this->expires_at = new \DateTime(date('Y-m-d H:i:s', $now + 86400 * 30));
        }
        
    }
}
