<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * BusinessServiceInterface.php  2.0
 * Febuary 5 2020
 *
 * BusinessServiceInterface acts as a skeloton outline to any of the business services being used
 */

namespace App\business;

interface BusinessServiceInterface{
    
    /**
     * Default constuctor
     */
    function __construct();
    
    /**
     * Method that takes in a full model to send to the database in order to save the information
     * @param $object - generic: an object Model
     */
    public function create($object);
    
    /**
     * Method that takes in an updated model to update the correct objects data
     * @param $object - generic: an object Model
     */
    public function update($object);
    
    /**
     * Mehtod that takes in the ID of the object to delete the object from the database
     * @param $id int: id number of the object within the database
     */
    public function delete(int $id);
    
    /**
     * Method that return the a list of all the objects in the data base
     */
    public function viewAll();
    
    /**
     * Method that takes in an ID of a specific object and returns a full object model
     * @param $id int: id number of the object within the database
     */
    public function viewById(int $id);
    
    /**
     * Method that looks through all the objects in the database to determin if the object inputed match 
     * with a object in the database
     * @param $object - generic: an object Model
     */
    public function authenticate($object);
    
}