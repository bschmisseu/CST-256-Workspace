 <?php

namespace App\Data;

use \Illuminate\Support\Facades\Log;
use App\model\User;

Class SecurityDAO {
    
    private $databse = null;
    
    function __construct($database)
    {
        $this->database = $database;
    }
    
    public function findByUser(User $user)
    {
        Log::info("Entering SecurityDAO.findByUser(User)");
        
        try{
            
            $userName = $user->getUserName();
            $password = $user->getPassword();
            
            $statement = $this->database->prepare('SELECT * FROM USERS WHERE USERNAME = :username and PASSWORD = :password');
            $statement->bindParam(':username', $userName);
            $statement->bindParam(':password', $password);
            $statement->execute();
            
            if($statement->rowCount() == 1)
            {
                Log::info("Exit Security DAO.findByUser() with true");
                return true;
            }
            
            else
            {
                Log::info("Exit Security DAO.findByUser() with false");
                return false;
            }
        }
        
        catch(\PDOException $e) {
            
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}