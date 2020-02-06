<?php

namespace App\model;

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * Job 2.0
 * Febuary 5 2020
 *
 * Job model inorder to store the information of the users past work expirence
 */

Class Job
{
    private $id;
    private $title;
    private $companyName;
    private $startingDate;
    private $endingDate;
    private $description;
    
    /**
     * Constructor poulated with all properies inorder when creating the object to set the varibles
     * @param $id - int: The job objects id number with in the database
     * @param $title - string: The job title at the job
     * @param $companyName - string: the name of the company in which the job was
     * @param $startDate - string: the date in which started at the school
     * @param $startDate - string: the date in which ended at the school
     * @param $description - string: the users decription of the job
     */
    function __construct($id, $title, $company, $startingDate, $endingDate, $description)
    {
        $this->id = $id; 
        $this->title = $title;
        $this->companyName = $company;
        $this->startingDate = $startingDate;
        $this->endingDate = $endingDate;
        $this->description = $description;
    }
    
    /**
     * Getter function for the id property
     * @return $id - int: The job objects id number with in the database
     */
    public function getId()
    {
        return $this->id; 
    }
    
    /**
     * Getter method for the title property
     * @return $title - string: The job title at the job
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Getter method for the company name
     * @return $companyName - string: the name of the company in which the job was
     */
    public function getCompanyName()
    {
        return $this->companyName; 
    }
    
    /**
     * The getter method for the Start Date property
     * @return $startDate - string: the date in which started at the school
     */
    public function getStartingDate()
    {
        return $this->startingDate;
    }
    
    /**
     * The getter method for the End Date property
     * @return $startDate - string: the date in which ended at the school
     */
    public function getEndingDate()
    {
        return $this->endingDate;
    }
    
    /**
     * The getter method for the description property
     * @return $description - string: the users decription of the job
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Setter function for the id property
     * @param $id - int: The job objects id number with in the database
     */
    public function setId($id)
    {
        $this->id = $id; 
    }
    
    /**
     * Setter method for the title property
     * @param $title - string: The job title at the job
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Setter method for the company name
     * @param $companyName - string: the name of the company in which the job was
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName; 
    }
    
    /**
     * The setter method for the Start Date property
     * @param $startDate - string: the date in which started at the school
     */
    public function setStartingDate($startingDate)
    {
        $this->startingDate = $startingDate;
    }
    
    /**
     * The setter method for the description property
     * @param $description - string: the users decription of the job
     */
    public function setEndingDate($endingDate)
    {
        $this->endingDate = $endingDate;
    }
    
    /**
     * The setter method for the description property
     * @param $description - string: the users decription of the job
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}