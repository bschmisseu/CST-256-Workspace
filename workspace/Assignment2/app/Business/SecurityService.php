<?php

namespace App\Business;

use \PDO;
use App\model\User;
use Illuminate\Support\Facades\Log;
use App\Data\SecurityDAO;

class SecurityService {
    
    function authenticateUser(User $user)
    {
        //Log to see when the controller method is reached
        Log::info("Entering SecurityService.authenticateUser(User)");
        
        //Gets all database varibles from the database.php file with in the config folder
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //Using PDO creates a a connection to the database 
        $database = new PDO("mysql:host=$servername; port=$port; dbname=$dbname", $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new SecurityDAO($database);
        $flag = $service->findByUser($user);
        
        $database = null;
        
        Log::info("Exit SecurityService.login() with flag: " . $flag);
        return $flag;
    }
}