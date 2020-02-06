<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * LoginRegistrationController.php  2.0
 * Febuary 5 2020
 *
 * DataServiceInterface is used as a stucture for any of the data services to inherit
 */

namespace App\data;

interface DataServiceInterface{
    
    function __construct();
    
    /**
     * Create Object takes in an object that is then sent to the data service
     * @param $object - generic: an object Model
     */
    public function create($object);
    
    /**
     * Update user takes in an object that is then passed through to the data service to be updated within the database
     * @param $object - generic: an object Model
     */
    public function update($object);
    
    /**
     * Delete user takes in an integer of an id of a user to be delete within the database
     * @param $id int: id number of the object within the database
     */
    public function delete(int $id);
    
    /**
     * View all returns a list of all object models from the database
     */
    public function viewAll();
    
    /**
     * ViewById takes in an id that will then return the full model of the object
     * @param $id int: id number of the object within the database
     */
    public function viewById(int $id);
}