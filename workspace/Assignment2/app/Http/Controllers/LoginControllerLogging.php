<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\model\User;
use App\business\SecurityService;
use Exception;

class LoginControllerLogging extends Controller
{
    public function loginUser(Request $request)
    {
        Log::info("Entering loginUser() from LoginControllerLogging");
        
        try {
            $this->validateForm($request);
            
            $userName = $request->input('userName');
            $password = $request->input('password');
            Log::info("Parameters", array("username" => $userName, "password" => $password));
            
            $user = new User(1, $userName, $password);
            
            $service = new SecurityService();
            $status = $service->authenticateUser($user);
            
            if($status)
            {
                Log::info("Exiting loginUser() with login passed");
                $data = ['model' => $user];
                return view('loginPassedBlade')->with($data);
            }
            
            else
            {
                Log::info("Exiting loginUser() with login failed");
                return view('loginFailedBlade');
            }
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            
            Log::error("Error : loginUser() in LoginControllerLoggin " , array("error messages" => $e->getMessage()));
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
