<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Insideboard\DbBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

use Insideboard\DbBundle\Document\OrganizationalUnit;
use Insideboard\DbBundle\Document\GradeCategory;
use Insideboard\DbBundle\Document\Grade;
use Insideboard\DbBundle\Document\Resource;

class XmlImporterCommand extends ContainerAwareCommand
{
    
    private $output = null;
    private $xmlUrl = __DIR__ . '/../../../integrated-data.xml';
    private $xml = null;
    private $organizationalUnits = null;
    private $gradesCategories = null;
    private $grades = null;
    private $members = null;
    
    /**
     * Command configure function
     */
    protected function configure()
    {
        $this
            ->setName('xmlimporter:parse')
            ->setDescription('Importing Foobaz HR XML');
    }
    
    /**
     * 
     * Main command function
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xml = new \DOMDocument();
        $xml->load($this->xmlUrl);
        
        $this->output = $output;
        
        $this->loadXml();
        $this->handleOrganizationalUnits();
        $this->handleGradesCategories();
        $this->handleGrades();
        $this->handleMembers();
    }
    
    
    /**
     * Loading XML file from $this->xmlUrl
     */
    private function loadXml(){
        
        try {
            $this->xml = simplexml_load_file($this->xmlUrl);
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return;
        }
        
        //Organizational units
        $this->organizationalUnits = $this->xml->{'organizational-units'};
        
        //Grade cateories
        $this->gradesCategories = $this->xml->referential->{'grades-categories'};
        
        //Grades
        $this->grades = $this->xml->referential->grades;
        
        //Members
        $this->members = $this->xml->members;
        
    } 
    
    /**
     * imports Organizational units
     */
    private function handleOrganizationalUnits(){
        
        $this->output->writeln('------------ OU importation ------------');
        
        foreach ($this->organizationalUnits->{'organizational-unit'} as $ou) {
            
            $OuEntity = new OrganizationalUnit();
            $OuEntity->setName($ou->attributes()->name);
            $OuEntity->setType($ou->attributes()->type);
            $OuEntity->setSerial($ou->attributes()->head);
            
            if(isset($ou->attributes()->parent))
            {
                $parentOu = $this->getOrganizationalUnitByName($OuEntity->getName());                 
                $parentOu !== null ? $OuEntity->setParentId($parentOu->getId()) : '';
            }
            
            $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
            $dm->persist($OuEntity);
            $dm->flush();
            
            $this->output->writeln('OU imported : ' . $OuEntity->getName());
            
        }
        
    }
    
    
    /**
     * 
     * Retrieve an OU by its name
     * 
     * @param string $name
     * @return OrganizationalUnit
     */
    private function getOrganizationalUnitByName(string $name){
        
        $repository = $this->getContainer()->get('doctrine_mongodb')
                            ->getManager()
                            ->getRepository(OrganizationalUnit::class);
        
        return $ou = $repository->findOneByName($name);
        
    }
    
    
    /**
     * imports grade categories
     */
    private function handleGradesCategories(){
        
        $this->output->writeln('------------ GradeCategories importation ------------');
        
        foreach ($this->gradesCategories->{'grade-categorie'} as $gradeCateg) {
            
            $gradeCategEntity = new GradeCategory();
            $gradeCategEntity->setLabel($gradeCateg->attributes()->label);
            $gradeCategEntity->setSerial($gradeCateg->attributes()->code);
            
            $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
            $dm->persist($gradeCategEntity);
            $dm->flush();
            
            $this->output->writeln('Grade Category imported : ' . $gradeCategEntity->getLabel());
        }
        
    }
    
    /**
     * import grades
     */
    private function handleGrades(){
        
        $this->output->writeln('------------ Grades importation ------------');
        
        foreach ($this->grades->grade as $grade) {
            
            $gradeEntity = new Grade();
            $gradeEntity->setLabel($grade->attributes()->label);
            $gradeEntity->setSerial($grade->attributes()->code);
            
            if(isset($grade->attributes()->parent))
            {
                
                $gradeCategory = $this->getGradeCategoryBySerial($grade->attributes()->parent);
                $gradeCategory !== null ? $gradeEntity->setGradeCategoryId($gradeCategory->getId()) : '';
            }
            
            $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
            $dm->persist($gradeEntity);
            $dm->flush();
            
            $this->output->writeln('Grade imported : ' . $gradeEntity->getLabel());
        }
    }
    
    
    /**
     * 
     * Retrieve a grade category by its serial number
     * 
     * @param string $serial
     * @return GradeCategory
     */
    private function getGradeCategoryBySerial(string $serial){
        
        $repository = $this->getContainer()->get('doctrine_mongodb')
                            ->getManager()
                            ->getRepository(GradeCategory::class);
        
        return $ou = $repository->findOneBySerial($serial);
        
    }
    
    /**
     * Import members
     */
    private function handleMembers(){
        
        $this->output->writeln('------------ Members importation ------------');
        
        foreach ($this->members->member as $member) {
            
            $memberEntity = new Resource();
            $memberEntity->setRemoteId($member->attributes()->id);
            $memberEntity->setStaffNumber($member->identity->attributes()->staffNumber);
            $memberEntity->setCivility($member->name->attributes()->civility);
            $memberEntity->setFirstName($member->name->first);
            $memberEntity->setLastName($member->name->last);
            $memberEntity->setEmail($member->employee->attributes()->email);
            $memberEntity->setLogin($member->identity->attributes()->account);
            $memberEntity->setPicture($member->picture->data);
            $memberEntity->setPictureType($member->picture->attributes()->data);
            
            if(isset($member->employee->attributes()->grade))
            {
                
                $grade = $this->getGradeBySerial($member->employee->attributes()->grade);
                $grade !== null ? $memberEntity->setGradeId($grade->getId()) : '';
            }
            
            if(isset($member->employee->attributes()->uo))
            {
                
                $parentOu = $this->getOrganizationalUnitByName($member->employee->attributes()->uo);
                $parentOu !== null ? $memberEntity->setOuId($parentOu->getId()) : '';
            }
            
            $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
            $dm->persist($memberEntity);
            $dm->flush();
            
            
            $this->output->writeln('Member imported : ' . $memberEntity->getFirstName() . ' ' . $memberEntity->getLastName());
        }
        
    }
    
    /**
     * 
     * Retrieve Grade by its serial
     * 
     * @param string $serial
     * @return Grade
     */
    private function getGradeBySerial(string $serial){
        
        $repository = $this->getContainer()->get('doctrine_mongodb')
                            ->getManager()
                            ->getRepository(Grade::class);
        
        return $ou = $repository->findOneBySerial($serial);
        
    }
    
}