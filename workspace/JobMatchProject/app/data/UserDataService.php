<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * UserDataService.php  2.0
 * Febuary 5 2020
 *
 * UserDataService implements DataServiceInteraface to house method to read and write to the database
 */

namespace App\data;

use App\model\User;
use App\model\Job;
use App\model\Education;
use App\model\UserCredential;
use App\model\UserInformation;


Class UserDataService implements DataServiceInterface {
    
    private $connection;
    
    /**
     * Defualt Constuctor inorder to initialze the connection varible to the database
     */
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::viewById()
     */
    public function viewById(int $id)
    { 
        //Creates index counter for an array
        $indexJobs = 0;
        $indexEducation = 0; 
        
        //Stores all the SQL commands used to gather all the inforamtion of the user
        $sql_query_user = "SELECT * FROM USER WHERE ID = {$id}";
        $sql_query_user_cred = "SELECT * FROM USER_CREDENTIAL WHERE USER_ID = {$id}";
        $sql_query_user_info = "SELECT * FROM USER_INFO WHERE USER_ID = {$id}";
        $sql_query_jobs = "SELECT * FROM JOB WHERE USER_ID = {$id}";
        $sql_query_education = "SELECT * FROM EDUCATION WHERE USER_ID = {$id}";
        
        //Runs all the querys to the database
        $results_user = mysqli_query($this->connection, $sql_query_user);
        $results_user_cred = mysqli_query($this->connection, $sql_query_user_cred);
        $results_user_info = mysqli_query($this->connection, $sql_query_user_info);
        $results_job = mysqli_query($this->connection, $sql_query_jobs);
        $resutls_education = mysqli_query($this->connection, $sql_query_education);
        
        //Gets the users inforamtion from the queries
        $rowUser = $results_user->fetch_assoc();
        $rowUserCred = $results_user_cred->fetch_assoc();
        $rowUserInfo = $results_user_info->fetch_assoc();
        
        //Creates varibels of all the data from the database
        $firstName = $rowUser['FIRSTNAME'];
        $lastName = $rowUser['LASTNAME'];
        $email = $rowUser['EMAIL'];
        $phoneNumber = $rowUser['PHONENUMBER'];
        $objectRole = $rowUser['USER_ROLE'];
        $active = $rowUser['ACTIVE'];
        $objectName = $rowUserCred['USERNAME'];
        $password = $rowUserCred['PASSWORD'];
        $bio = $rowUserInfo['BIO'];
        $jobs = array();
        $educationHistory = array();
        
        //Loop to go through all the work expirence that the user has
        while($rowJobs = $results_job->fetch_assoc())
        {
            //Creates vaibles from the data of the database
            $jobId = $rowJobs['ID'];
            $jobTitle = $rowJobs['JOB_TITLE'];
            $company = $rowJobs['JOB_COMPANY'];
            $startDate = $rowJobs['START_DATE'];
            $endDate = $rowJobs['END_DATE'];
            $jobDescription = $rowJobs['DESCRIPTION'];
            
            //Creates a Job object and stores it into the array of jobs
            $currentJob = new Job($jobId, $jobTitle, $company, $startDate, $endDate, $jobDescription);
            $jobs[$indexJobs] = $currentJob;
            $indexJobs++; 
        }
        
        //Loop to go through all the education expirence that the user has
        while($rowEducation = $resutls_education->fetch_assoc())
        {
            //Creates vaibles from the data of the database
            $educationId = $rowEducation['ID'];
            $schoolName = $rowEducation['NAME'];
            $degree = $rowEducation['DEGREE'];
            $field = $rowEducation['FIELD'];
            $educationStartDate = $rowEducation['START_DATE'];
            $educationEndDate = $rowEducation['END_DATE'];
            $educationDescription = $rowEducation['DESCRIPTION'];
            
            //Creates a education object and stores it to the array of education history
            $currentEducation = new Education($educationId, $schoolName, $degree, $field, $educationStartDate, 
                                              $educationEndDate, $educationDescription);
            $educationHistory[$indexEducation] = $currentEducation;
            $indexEducation++;
        }
        
        //Creates a full user object
        $currentUserCreds = new UserCredential($objectName, $password);
        $currentUserInfo = new UserInformation($bio, $jobs, $educationHistory);
        $currentUser = new User($id, $firstName, $lastName, $email, $phoneNumber, $objectRole, $active, $currentUserCreds, $currentUserInfo);
        
        //Returns the full user model
        return $currentUser;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::create()
     */
    public function create($object)
    {
        //SQL statment to check to see if the user name if already taken
        $sqlCheck = "SELECT * FROM USER_CREDENTIAL WHERE USERNAME = '{$object->getUserCredential()->getUserName()}'";
        $results_check = mysqli_query($this->connection, $sqlCheck);
        $numberOfRows = mysqli_num_rows($results_check);
        
        //A decision to determin if the user name has been taken 
        if($numberOfRows <= 0)
        {
            //If the username has not been taken it will then create a SQL statemnt inorder to store the new users inforamtion
            $sqlStatement = "INSERT INTO `user` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `PHONENUMBER`, `USER_ROLE`, `ACTIVE`) 
                             VALUES (NULL, '{$object->getFirstName()}', '{$object->getLastName()}', '{$object->getEmail()}', 
                             '{$object->getPhoneNumber()}', '{$object->getUserRole()}', '{$object->isActive()}');";
            
            //Runs the query in the database
            $result = $this->connection->query($sqlStatement);
            
            //Retrieves the last id number that was stored in the database
            $objectID = mysqli_insert_id($this->connection);
            
            //Completes the user object by setting the id number
            $object->setIdNum($objectID);
            
            //If the prvious SQL Statment falid then it will return back to the business service
            if($result == false)
            {
                return $result;
            }
            
            else
            {
                //SQL statemnt to create write the inforamtion of the usercredential object
                $sqlStatement = "INSERT INTO `user_credential` (`USERNAME`, `PASSWORD`, `USER_ID`) VALUES 
                            ('{$object->getUserCredential()->getUserName()}', '{$object->getUserCredential()->getPassword()}', 
                            '{$object->getIdNum()}');";
                
                //Runs the query in the datbase
                $result = $this->connection->query($sqlStatement);
                
                $_SESSION['currentUser'] = $this->viewById($object->getIdNum());
                
                //Creates an inital job and education object for the user object
                $sqlJob = "INSERT INTO `JOB` (`ID`, `JOB_TITLE`, `JOB_COMPANY`, `START_DATE`, `END_DATE`, `DESCRIPTION`, `USER_ID`) 
                           VALUES (NULL, NULL, NULL, NULL, NULL, NULL, '{$object->getIdNum()}');";
                
                $sqlEducation = "INSERT INTO `EDUCATION` (`ID`, `NAME`, `DEGREE`, `FIELD`, `START_DATE`, `END_DATE`, `DESCRIPTION`, `USER_ID`) 
                                 VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{$object->getIdNum()}');";
                
                //Runs the querys through the database
                $result = $this->connection->query($sqlStatement);
                $result = $this->connection->query($sqlJob);
                $result = $this->connection->query($sqlEducation);
                
                //Sets the session of the full user object
                $_SESSION['currentUser'] = $this->viewById($object->getIdNum());
                
                return $result;
            }
        }
        
        else
        {
            //If the username has already been taken return the error code of 5
            return 5;
        }   
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::update()
     */
    public function update($object)
    {
        //Varible initialed to keep track of all the rows affected throughout the update proccess 
        $numRowsAffected = 0;
        
        //Creates SQL statments inorder update all the information of the user
        $sqlUser = "UPDATE `USER` SET `FIRSTNAME` = '{$object->getFirstName()}', `LASTNAME` = '{$object->getLastName()}', 
                    `EMAIL` = '{$object->getEmail()}', `PHONENUMBER` = '{$object->getPhoneNumber()}', `USER_ROLE` = 
                    '{$object->getUserRole()}', `ACTIVE` = '{$object->isActive()}' WHERE `USER`.`ID` = {$object->getIdNum()};";
        $sqlUserCreds = "UPDATE `USER_CREDENTIAL` SET `USERNAME` = '{$object->getUserCredential()->getUserName()}', 
                        `PASSWORD` = '{$object->getUserCredential()->getPassword()}' WHERE 
                        `USER_CREDENTIAL`.`USER_ID` = {$object->getIdNum()};";
        $sqlUserInfo = "UPDATE `USER_INFO` SET `BIO` = '{$object->getUserInformation()->getBio()}' WHERE 
                        `USER_INFO`.`USER_ID` = {$object->getIdNum()};";
        
        //Runs all the statments through the database
        $this->connection->query($sqlUser);
        $numRowsAffected += $this->connection->affected_rows;
        $this->connection->query($sqlUserCreds);
        $numRowsAffected += $this->connection->affected_rows;
        $this->connection->query($sqlUserInfo);
        $numRowsAffected += $this->connection->affected_rows;
        
        //Loop to run through all the jobs of the user inroder to update all the information
        foreach($object->getUserInformation()->getJobs() as $currentJob)
        {
            $sqlJob = "UPDATE `JOB` SET `JOB_TITLE` = '{$currentJob->getTitle()}', 
                      `JOB_COMPANY` = '{$currentJob->getCompanyName()}', `START_DATE` = '{$currentJob->getStartingDate()}', 
                      `END_DATE` = '{$currentJob->getEndingDate()}', `DESCRIPTION` = '{$currentJob->getDescription()}' WHERE 
                      `JOB`.`ID` = {$currentJob->getId()};";
            
            $this->connection->query($sqlJob);
            $numRowsAffected += $this->connection->affected_rows;
        }
        
        //Loop to iterate through all the users education history inorder to update all the information
        foreach($object->getUserInformation()->getEducationHistory() as $currentEducation)
        {
            $sqlEducation = "UPDATE `EDUCATION` SET `NAME` = '{$currentEducation->getName()}', `DEGREE` = '{$currentEducation->getDegree()}', 
                            `FIELD` = '{$currentEducation->getField()}', `START_DATE` = '{$currentEducation->getStartDate()}', 
                            `END_DATE` = '{$currentEducation->getEndDate()}', `DESCRIPTION` = '{$currentEducation->getDescription()}' 
                             WHERE `EDUCATION`.`ID` = {$currentEducation->getId()};";
            
            $this->connection->query($sqlEducation);
            $numRowsAffected += $this->connection->affected_rows;
        }
        
        //Return the number of rows affected by the update 
        return $numRowsAffected;
    }

    public function delete(int $id)
    {
        //Varible initialed to keep track of all the rows affected throughout the deletion proccess 
        $numRowsAffected = 0;
        
        //Creates SQL Stamtments to delete all traces of the user
        $sqlUser = "DELETE FROM `USER` WHERE `ID`= {$id};";
        $sqlUserCred = "DELETE FROM `USER_CREDENTIAL` WHERE `USER_ID`= {$id};";
        $sqlUserInfo = "DELETE FROM `USER_INFO` WHERE `USER_ID`= {$id};";
        $sqlJobs = "DELETE FROM `JOB` WHERE `USER_ID`= {$id};";
        $sqlEducation = "DELETE FROM `EDUCATION` WHERE `USER_ID`= {$id};";
        
        //Runs all SQL statements through the database while also incrementing the number of rows affted
        $this->connection->query($sqlUserCred);
        $numRowsAffected += $this->connection->affected_rows;
        
        $this->connection->query($sqlUserInfo);
        $numRowsAffected += $this->connection->affected_rows;
        
        $this->connection->query($sqlJobs);
        $numRowsAffected += $this->connection->affected_rows;
        
        $this->connection->query($sqlEducation);
        $numRowsAffected += $this->connection->affected_rows;
        
        $this->connection->query($sqlUser);
        $numRowsAffected += $this->connection->affected_rows;
        
        //Returns the number of rows affected
        return $numRowsAffected;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\data\DataServiceInterface::viewAll()
     */
    public function viewAll()
    {
        //creates an array to store the objects
        $objects = array(); 
        $indexUser = 0; 
        
        //SQL statment that is run to return all the rows of users in the database
        $sqlQuery = "SELECT * FROM USER";
        $resutls = mysqli_query($this->connection, $sqlQuery);
        
        //While loop to iterate through all the rows that were returned
        while($row = $resutls->fetch_assoc())
        {
            //Gets the users id of current user
            $id = $row['ID'];
            
            //Intialized a varible with the users object 
            $currentUser = $this->viewByID($id);
            
            //Adds the users object to the array
            $objects[$indexUser] = $currentUser;
            $indexUser++;
        }
        
        //returns the array of objects 
        return $objects;
    }



    
}