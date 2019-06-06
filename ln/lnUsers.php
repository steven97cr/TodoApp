<?php
require_once(__DIR__."/../db/dbUsers.php");
class lnUsers{

    var $dbUsers; 

    function __construct(){
        $this -> dbUsers = new dbUsers();
    }

    function addUser($newUser){
        return $this -> dbUsers -> addUser($newUser);
    }

    function getUserLogin($user, $pass){
        return $this -> dbUsers -> getUserLogin($user,$pass);
    }
}
?>