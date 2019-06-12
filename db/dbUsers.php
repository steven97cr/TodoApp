<?php
require_once(__DIR__.'/connection.php');
class dbUsers extends Connection{

    function __construct(){
        parent::__construct();
    }

    function addUser($newUser){
        extract($newUser);
        $query = "call spAddUser('$fullName','$userName','default.png','$userMail','$userPass');";
        return $this -> query($query);
    }

    function getUserLogin($user, $pass){
        $user = addslashes($user);
        $pass = addslashes($pass);
        
        $query = "call spGetUserLogin('$user','$pass');";
        $data = $this -> fetchQuery($query);
        return $data;
    }

    function editUser($editUser){
        extract($editUser);
        $query = "call spEditUser($userID,'$fullName','$userName','$userPhoto','$userMail','$userPass');";
        $data = $this -> query($query);
        return $data;
    }

}
?>