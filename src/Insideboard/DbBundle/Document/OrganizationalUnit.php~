<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Insideboard\DbBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class OrganizationalUnit
{
    /**
     * @MongoDB\Id
     */
    protected $id;
    
    /**
     * @MongoDB\Field(type="string")
     */
    protected $serial;
    
     /**
     * @MongoDB\Field(type="string")
     */
    protected $name;
    
     /**
     * @MongoDB\Field(type="string")
     */
    protected $type;
    
    /** 
     * @MongoDB\EmbedOne(targetDocument="OrganizationalUnit") 
     */
    protected $parent;

    

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serial
     *
     * @param string $serial
     * @return $this
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
        return $this;
    }

    /**
     * Get serial
     *
     * @return string $serial
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set parent
     *
     * @param Insideboard\DbBundle\Document\OrganizationalUnit $parent
     * @return $this
     */
    public function setParent(\Insideboard\DbBundle\Document\OrganizationalUnit $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Insideboard\DbBundle\Document\OrganizationalUnit $parent
     */
    public function getParent()
    {
        return $this->parent;
    }
}
