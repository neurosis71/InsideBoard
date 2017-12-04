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
class Grade 
{
    /**
     * @MongoDB\Id
     */
    private $id;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $serial;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $label;
    
    /** 
     * @MongoDB\EmbedOne(targetDocument="GradeCategory") 
     */
    private $gradeCategory;
    

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
     * Set label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set gradeCategory
     *
     * @param Insideboard\DbBundle\Document\GradeCategory $gradeCategory
     * @return $this
     */
    public function setGradeCategory(\Insideboard\DbBundle\Document\GradeCategory $gradeCategory)
    {
        $this->gradeCategory = $gradeCategory;
        return $this;
    }

    /**
     * Get gradeCategory
     *
     * @return Insideboard\DbBundle\Document\GradeCategory $gradeCategory
     */
    public function getGradeCategory()
    {
        return $this->gradeCategory;
    }
}
