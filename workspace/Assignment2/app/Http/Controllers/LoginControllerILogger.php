<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\model\User;
use App\business\SecurityService;
use App\Services\Utility\MyLogger;
use Exception;

class LoginControllerILogger extends Controller
{
    public function loginUser(Request $request)
    {
        MyLogger::info("Entering loginUser() from LoginControllerILogger");
        
        try {
            $this->validateForm($request);
            
            $userName = $request->input('userName');
            $password = $request->input('password');
            MyLogger::info("Parameters", array("username" => $userName, "password" => $password));
            
            $user = new User(1, $userName, $password);
            
            $service = new SecurityService();
            $status = $service->authenticateUser($user);
            
            if($status)
            {
                MyLogger::info("Exiting loginUser() in LoginControllerILogger with login passed");
                $data = ['model' => $user];
                return view('loginPassedBlade')->with($data);
            }
            
            else
            {
                MyLogger::info("Exiting loginUser() in LoginControllerILogger with login failed");
                return view('loginFailedBlade');
            }
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            
            MyLogger::error("Error : loginUser() in LoginControllerILogger " , array("error messages" => $e->getMessage()));
            return view('errorPage');
        } 
    }
    
    private function validateForm(Request $request)
    {
        $rules = ['userName' => 'Required | Between:4,20 | Alpha',
                  'password' => 'Required | Between:4,20'];
        
        $this->validate($request, $rules);
    }
}