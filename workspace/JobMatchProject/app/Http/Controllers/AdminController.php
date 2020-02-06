<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * AdminController.php  2.0
 * Febuary 5 2020
 *
 * Admin controller in order to pass through data from the views to the buessiness methods
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\business\UserBusinessService; 

class AdminController extends Controller
{
    private $service;
    
    /**
     * Defualt contstructor to initialize the Business Service object
     */
    function __construct()
    {
        $this->service = new UserBusinessService();
    }
    
    /**
     * Directs the user to the admin page with an array of all users
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - admin page
     */
    public function adminPage()
    {
        //Gets an array of all users within the database 
        $data = ['userList' => $this->service->viewAll()];
        
        //returns the admin page view
        return view('admin')->with($data); 
    }
    
    /**
     * Method called when the admin is deleteing a users
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - admin page
     */
    public function deleteUser(Request $request)
    {
        //Gets the users id that is being requested to delete
        $userId = $request->input('userId');
        
        //Calls the business service to delete the user based on the user id given
        $this->service->delete($userId);
        
        //Refreshes the admin page with an updated list of users from the business service
        $data = ['userList' => $this->service->viewAll()];
        return view('admin')->with($data); 
    }
    
    /**
     * Mehtod called when the admin has requested to suspend a user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - admin page
     */
    public function suspendUser(Request $request)
    {
        //Gets the users id that is being requested to suspend
        $userId = $request->input('userId');
        
        //Gets the full user object from the business service based on the id
        $currentUser = $this->service->viewById($userId);
        
        //A decision to see if the user needs to be suspended or un suspended
        if($currentUser->isActive() == 1)
        {
            $currentUser->setActive(0);
        }
        
        else
        {
            $currentUser->setActive(1);
        }
        
        //Updates the users information by calling the update method within the business service
        $this->service->update($currentUser);
        
        //Refreshes the admin page with an updated list of the users
        $data = ['userList' => $this->service->viewAll()];
        return view('admin')->with($data); 
    }
    
    /**
     * Mehtod called with the admin is looking to get the full informaiton of the user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - users profile page
     */
    public function viewUser(Request $request)
    {
        //Gets the users id that the request is made on the get more information 
        $userId = $request->input('userId');
        
        //Redirects the user to a page where all the information of the users is displayed with the users object
        $data = ['currentUser' => $this->service->viewById($userId)];
        return view('adminUserView')->with($data); 
    }
}
