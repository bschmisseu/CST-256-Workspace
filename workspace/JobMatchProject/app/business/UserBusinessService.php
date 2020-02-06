<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * LoginRegistrationController.php  2.0
 * Febuary 5 2020
 *
 * LoginRegistrationController in order to pass through data from the views to the buessiness methods
 */

namespace App\business;

use App\data\UserDataService;

class UserBusinessService implements BusinessServiceInterface{
    
    private $dataService;
    
    /**
     *
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::__construct()
     */
    public function __construct()
    {
        $this->dataService = new UserDataService();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::authenticate()
     */
    public function authenticate($object)
    {
        //Gets an array of users from the data service
        $users = $this->dataService->viewAll();
        
        //Sets variables for the current user 
        $userName = $object->getUserCredential()->getUserName();
        $password = $object->getUserCredential()->getPassword(); 
        $validUser = false;
        
        //For loop to search through all the users in the database
        for($i = 0; $i < count($users); $i++)
        {
            //Sets variables of the current user
            $currentUser = $users[$i];
            $currentUserName = $currentUser->getUserCredential()->getUserName();
            $currentPassword = $currentUser->getUserCredential()->getPassword();
            
            //Desicion to see if the user credential match from the database
            if(strcmp($currentUserName, $userName) == 0 && strcmp($currentPassword, $password) == 0)
            {
                //If true then sets the varibles
                $validUser = true;
                $_SESSION['currentUser'] = $currentUser;
            }
        }
        
        return $validUser;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewById()
     */
    public function viewById(int $id)
    {
        //returns a user model from the database
        return $this->dataService->viewById($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::create()
     */
    public function create($object)
    {
        //Sends a object to to the data service in write to the database
        return $this->dataService->create($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::update()
     */
    public function update($object)
    {
        //Sends an updated object to the data service
        return $this->dataService->update($object);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::delete()
     */
    public function delete(int $id)
    {
        //Sends an id of an object to be deleted
        return $this->dataService->delete($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \App\business\BusinessServiceInterface::viewAll()
     */
    public function viewAll()
    {
        //Request an array of all user objects from the data service
        return $this->dataService->viewAll();
    }

   
    
}