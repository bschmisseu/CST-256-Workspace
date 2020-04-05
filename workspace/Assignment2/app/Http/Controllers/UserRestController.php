<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Exception;
use App\business\SecurityService;
use App\model\DTO; 

class UserRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $service = new SecurityService();
            $users = $service->getAllUser();
            
            $dto = new DTO(0, "OK", $users);
            
            $json = json_encode($dto);
            
            return $json; 
        }
        catch(Exception $e1)
        {
            Log::info("Inside catch of UserRestController@index: '{$e1->getMessage()}'");
            $dto = new DTO(-2, $e1->getMessage(), array());
            
            $json = json_encode($dto);
            
            return $json; 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $service = new SecurityService();
            $user = $service->getUser($id);
            
            if($user == null)
                $dto = new DTO(-1, "No User Found", $user);
            else    
                $dto = new DTO(0, "OK", $user);
            
            $json = json_encode($dto);
            
            return $json;
        }
        catch(Exception $e1)
        {
            $dto = new DTO(-2, $e1->getMessage(), array());
            
            $json = json_encode($dto);
            
            return $json;
        }
    }
}
