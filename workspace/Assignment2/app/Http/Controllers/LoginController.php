<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use App\model\User;
use App\business\SecurityService;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $userName = $request->input('userName');
        $password = $request->input('password');
        
        $user = new User(1, $userName, $password);
        
        $service = new SecurityService();
        $status = $service->authenticateUser($user);
        
        if($status)
        {
            $data = ['model' => $user];
            return view('loginPassed')->with($data);
        }
         
        else
        {
            return view('loginFailed'); 
        }
    }
}
