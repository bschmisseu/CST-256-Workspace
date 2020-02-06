<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 2.0
 * LoginRegistrationController.php  2.0
 * Febuary 5 2020
 *
 * LoginRegistrationController in order to pass through data from the views to the buessiness methods
 */

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\model\User;
use App\business\UserBusinessService;
use App\model\UserCredential;
use App\model\UserInformation;

session_start(); 

class LoginRegistrationController extends Controller
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
     * Controller method when the user is trying to log in to make sure the user if valid before leading them to the homepage
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - home page
     */
    public function authenticateUser(Request $request)
    {
        //Gathers the inforamtion from the login form
        $userName = $request->input('userName');
        $password = $request->input('password');
        
        //Creates a full user model inorder to send to the buessiness service
        $userCredentials = new UserCredential($userName, $password);
        $userInfo = new UserInformation("", null, null);
        $user = new User(0, "", "", "", "", 0, 1, $userCredentials, $userInfo);
        
        //Calls a business service method inorder to see if the user is able to login 
        if($this->service->authenticate($user, $request))
        {
            //If the users credetials are correct it will grab the overwritten user object from the session
            $currentUser = $_SESSION['currentUser'];
            
            //A descision is made to see if the account has been suspended
            if($currentUser->isActive() == 1)
            {
                //If the user is not suspended it will send the user to the homepage after setting the session of blade
                $request->session()->put('currentUser', $currentUser);
                $data = ['returnMessage' => "Welcome Back " . $currentUser->getFirstName()];
                return view('homePage')->with($data);
            }
            
            else 
            {
                //If the users account has been disabled the user will be sent back to the login form with an error messages displaying such
                $data = ['returnMessage' => "Your Account Has Been Temporarily Disabled!"];
                return view('login')->with($data);
            }
        }
        
        else
        {
            //If not user credentials match then the user will be sent back to the login form
            $data = ['returnMessage' => "Incorrect User Name or Password!"];
            return view('login')->with($data);
        }
        
    }
    
    /**
     * Controller method that takes in all information from registration form to push the information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - home page
     */
    public function registerUser(Request $request)
    {
        //Gathers all information from the registration form
        $firstName =  $request->input('firstName');
        $lastName =  $request->input('lastName');
        $phoneNumber =  $request->input('phoneNumber');
        $email =  $request->input('email');
        $userName =  $request->input('userName');
        $password =  $request->input('password');
        
        //Creates a full user object based on the information given
        $userCredentials = new UserCredential($userName, $password);
        $userInfo = new UserInformation("", null, null);
        $user = new User(0, $firstName, $lastName, $email, $phoneNumber, 1, 1, $userCredentials, $userInfo);
        
        //Calls a business service method inorder to write the user into the database
        $result = $this->service->create($user);
        
        //Decision to determin the outcome of the query
        if($result == 1)
        {
            //If there was no problem it will send the user to the home page 
            $request->session()->put('currentUser', $_SESSION['currentUser']);
            $data = ['returnMessage' => "Thank you for Joining "  . $user->getFirstName()];
            return view('homePage')->with($data);
        }
        
        else if($result == 5)
        {
            //If the users information was already in the data base they were sent back to the registration form
            $data = ['returnMessage' => "User Name Already Taken!"];
            return view('registration')->with($data); 
        }
        
        else
        {
            //If there was an error proccessing their request they were sent back to the registration form
            $data = ['returnMessage' => "Error Processing Request!"];
            return view('login')->with($data); 
        }
    }
    
    /**
     * Method called with the user is updating their information
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - user profile page
     */
    public function editUser(Request $request)
    {
        //Gathers all information form the edit form
        $firstName =  $request->input('firstName');
        $lastName =  $request->input('lastName');
        $phoneNumber =  $request->input('phoneNumber');
        $email =  $request->input('email');
        $userName =  $request->input('userName');
        $password =  $request->input('password');
        $bio =  $request->input('bio');
        $schoolName =  $request->input('schoolName');
        $degree =  $request->input('degree');
        $field =  $request->input('field');
        $educationStartDate =  $request->input('educationStartDate');
        $educationEndDate =  $request->input('educationEndDate');
        $educationDescription =  $request->input('educationDescription');
        $jobTitle =  $request->input('jobTitle');
        $companyName =  $request->input('companyName');
        $jobStartDate =  $request->input('jobStartDate');
        $jobEndDate =  $request->input('jobEndDate');
        $jobDescription =  $request->input('jobDescription');
        
        //Gets the user credetial object and the users information object inorder to update the information 
        $currentUser = $request->session()->get('currentUser');
        $currentUserCredential = $currentUser->getUserCredential();
        $currentUserInforamtion = $currentUser->getUserInformation();
        
        //Sets the new values to the user object model
        $currentUser->setFirstName($firstName);
        $currentUser->setLastName($lastName);
        $currentUser->setPhoneNumber($phoneNumber);
        $currentUser->setEmail($email);
        $currentUserCredential->setUserName($userName);
        $currentUserCredential->setPassword($password);
        $currentUserInforamtion->setBio($bio);
        $currentEducation = $currentUserInforamtion->getEducationHistory()[0];
        $currentEducation->setName($schoolName);
        $currentEducation->setDegree($degree);
        $currentEducation->setField($field);
        $currentEducation->setStartDate($educationStartDate);
        $currentEducation->setEndDate($educationEndDate);
        $currentEducation->setDescription($educationDescription);
        $currentJob = $currentUserInforamtion->getJobs()[0];
        $currentJob->setTitle($jobTitle);
        $currentJob->setCompanyName($companyName);
        $currentJob->setStartingDate($jobStartDate);
        $currentJob->setEndingDate($jobEndDate);
        $currentJob->setDescription($jobDescription);
        $currentUserInforamtion->getEducationHistory()[0] = $currentEducation;
        $currentUserInforamtion->getJobs()[0] = $currentJob;
        $currentUser->setUserCredentials($currentUserCredential);
        $currentUser->setUserInformation($currentUserInforamtion);
        
        //Calles the update bussiness service function inorder to update the users inforamtion inside the database
        $this->service->update($currentUser);
        $_SESSION['currentUser'] = $currentUser;
        
        //Refreshes the users profile page with they updated user model
        $request->session()->put('currentUser', $currentUser);
        return view('profile');
    }
    
    /**
     * Logout method that gets called when the user is trying to logout
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory - the index page
     */
    public function logout(Request $request)
    {
        //Forgets the current user within the session
        $request->session()->forget('currentUser');
        
        //Returns the user to the index page
        return view('index');
    }
}