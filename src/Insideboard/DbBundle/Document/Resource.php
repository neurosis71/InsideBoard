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
class Resource
{
    /**
     * @MongoDB\Id
     */
    private $id;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $remoteId;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $staffNumber;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $login;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $lastName;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $firstName;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $civility;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $email;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $gradeId;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $ouId;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $picture;
    
    /**
     * @MongoDB\Field(type="string")
     */
    private $pictureType;

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
     * Set login
     *
     * @param string $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * Get login
     *
     * @return string $login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set civility
     *
     * @param string $civility
     * @return $this
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;
        return $this;
    }

    /**
     * Get civility
     *
     * @return string $civility
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return $this
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * Get picture
     *
     * @return string $picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    

    /**
     * Set gradeId
     *
     * @param string $gradeId
     * @return $this
     */
    public function setGradeId($gradeId)
    {
        $this->gradeId = $gradeId;
        return $this;
    }

    /**
     * Get gradeId
     *
     * @return string $gradeId
     */
    public function getGradeId()
    {
        return $this->gradeId;
    }

    /**
     * Set ouId
     *
     * @param string $ouId
     * @return $this
     */
    public function setOuId($ouId)
    {
        $this->ouId = $ouId;
        return $this;
    }

    /**
     * Get ouId
     *
     * @return string $ouId
     */
    public function getOuId()
    {
        return $this->ouId;
    }

    /**
     * Set remoteId
     *
     * @param string $remoteId
     * @return $this
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;
        return $this;
    }

    /**
     * Get remoteId
     *
     * @return string $remoteId
     */
    public function getRemoteId()
    {
        return $this->remoteId;
    }

    /**
     * Set staffNumber
     *
     * @param string $staffNumber
     * @return $this
     */
    public function setStaffNumber($staffNumber)
    {
        $this->staffNumber = $staffNumber;
        return $this;
    }

    /**
     * Get staffNumber
     *
     * @return string $staffNumber
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
    }

    /**
     * Set pictureType
     *
     * @param string $pictureType
     * @return $this
     */
    public function setPictureType($pictureType)
    {
        $this->pictureType = $pictureType;
        return $this;
    }

    /**
     * Get pictureType
     *
     * @return string $pictureType
     */
    public function getPictureType()
    {
        return $this->pictureType;
    }
}
