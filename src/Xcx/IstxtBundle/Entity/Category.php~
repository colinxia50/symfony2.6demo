<?php

namespace Xcx\IstxtBundle\Entity;


/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    public $isdocs;
    
    public $active_isdoc;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isdocs = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Category
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
     * Add isdocs
     *
     * @param \Xcx\IstxtBundle\Entity\Isdoc $isdocs
     * @return Category
     */
    public function addIsdoc(\Xcx\IstxtBundle\Entity\Isdoc $isdocs)
    {
        $this->isdocs[] = $isdocs;
    
        return $this;
    }

    /**
     * Remove isdocs
     *
     * @param \Xcx\IstxtBundle\Entity\Isdoc $isdocs
     */
    public function removeIsdoc(\Xcx\IstxtBundle\Entity\Isdoc $isdocs)
    {
        $this->isdocs->removeElement($isdocs);
    }

    /**
     * Get isdocs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIsdocs()
    {
        return $this->isdocs;
    }
    
    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }
    
    public function setActiveJobs($isdocs)
    {
        $this->active_isdoc = $isdocs;
    }
    
    public function getActiveJobs()
    {
        return $this->active_isdoc;
    }
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $isdoc;


    /**
     * Get isdoc
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIsdoc()
    {
        return $this->isdoc;
    }
}
