<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\model\User;
use App\business\SecurityService;
use App\Services\Utility\MyLoggerMono;
use Exception;

class LoginControllerMonoLog extends Controller
{
    public function loginUser(Request $request)
    {
        MyLoggerMono::info("Entering loginUser() from LoginControllerMonoLog");
        
        try {
            $this->validateForm($request);
            
            $userName = $request->input('userName');
            $password = $request->input('password');
            MyLoggerMono::info("Parameters", array("username" => $userName, "password" => $password));
            
            $user = new User(1, $userName, $password);
            
            $service = new SecurityService();
            $status = $service->authenticateUser($user);
            
            if($status)
            {
                MyLoggerMono::info("Exiting loginUser() in LoginControllerMonoLog with login passed");
                $data = ['model' => $user];
                return view('loginPassedBlade')->with($data);
            }
            
            else
            {
                MyLoggerMono::info("Exiting loginUser() in LoginControllerMonoLog with login failed");
                return view('loginFailedBlade');
            }
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            
            MyLoggerMono::error("Error : loginUser() in LoginControllerMonoLog " , array("error messages" => $e->getMessage()));
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
