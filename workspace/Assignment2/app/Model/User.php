<?php

namespace App\model;

Class User
{
    private $idNum;
    private $userName;
    private $password;
    
    function __construct($idNum, $userName, $password)
    {
        $this->idNum = $idNum;
        $this->userName = $userName;
        $this->password = $password;
    }
    
    public function getIdNum()
    {
        return $this->idNum;
    }
    
    public function getUserName()
    {
        return $this->userName;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

?>