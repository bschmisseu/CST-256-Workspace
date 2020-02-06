<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use Exception;
use Illuminate\Http\Request;
use App\Model\User;
use App\Business\SecurityService;
use Illuminate\Validation\ValidationException;

class LoginControllerValidation extends Controller
{
    public function loginUser(Request $request)
    {
        try {
            $this->validateForm($request);
            
            $userName = $request->input('userName');
            $password = $request->input('password');
            
            $user = new User(1, $userName, $password);
            
            $service = new SecurityService();
            $status = $service->authenticateUser($user);
            
            if($status)
            {
                $data = ['model' => $user];
                return view('loginPassedBlade')->with($data);
            }
            
            else
            {
                return view('loginFailedBlade');
            }
        }
        
        catch(ValidationException $invalidException) {
            throw $invalidException;
        }
        
        catch (Exception $e) {
            return view('SystemException');
        } 
    }
    
    private function validateForm(Request $request)
    {
        $rules = ['userName' => 'Required | Between:4,20 | Alpha',
                  'password' => 'Required | Between:4,20'];
        
        $this->validate($request, $rules);
    }
}