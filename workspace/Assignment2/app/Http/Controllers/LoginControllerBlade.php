<?php

namespace App\Http\Controllers;

use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\business\SecurityService;

Class LoginControllerBlade extends Controller
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
            return view('loginPassedBlade')->with($data);
        }
        
        else
        {
            return view('loginFailedBlade'); 
        }
    }
}
