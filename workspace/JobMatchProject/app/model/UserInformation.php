<?php

namespace App\model;

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * UserInforamtion 2.0
 * Febuary 5 2020
 *
 * User information model to store more information about the user
 */

Class UserInformation
{
    private $bio;
    private $jobs;
    private $educationHistory;
    
    /**
     * Constructor poulated with all properies inorder when creating the object to set the varibles
     * @param $bio - string: The users bio to explain more about themselves
     * @param $jobs - array: and array of Jobs that the users has had
     * @param $educationHistory - array: and array of the users education expirence
     */
    function __construct($bio, $jobs, $educationHistory)
    {
        $this->bio = $bio;
        $this->jobs = $jobs;
        $this->educationHistory = $educationHistory;
    }
    
    /**
     * The getter method for the bio property
     * @return $bio - string: The users bio to explain more about themselves 
     */
    public function getBio()
    {
        return $this->bio;
    }
    
    /**
     * The getter method for the jobs property
     * @return $jobs - array: and array of Jobs that the users has had
     */
    public function getJobs()
    {
        return $this->jobs;
    }
    
    /**
     * The getter method for the education history property
     * @return $educationHistory - array: and array of the users education expirence
     */
    public function getEducationHistory()
    {
        return $this->educationHistory;
    }
    
    /**
     * The setter method for the bio property
     * @param $bio - string: The users bio to explain more about themselves
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }
    
    /**
     * The setter method for the jobs property
     * @param $jobs - array: and array of Jobs that the users has had
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }
    
    /**
     * The setter method for the education history property
     * @param $educationHistory - array: and array of the users education expirence
     */
    public function setEducationHistory($educationHistory)
    {
        $this->educationHistory = $educationHistory;
    }
}