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

    function editUser($editUser){
        if(!empty($_FILES['userPhoto']['name'])){
            $path = __DIR__."/../assets/img/";
            $path = $path . basename( $_FILES['userPhoto']['name']);
            if(move_uploaded_file($_FILES['userPhoto']['tmp_name'], $path)) {
                // echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
                // " has been uploaded";
                $editUser['userPhoto'] = basename($_FILES['userPhoto']['name']);
            } else{
                return "Ocurrio un error con la foto de perfil!";
            }
        }
        
        return $this -> dbUsers -> editUser($editUser);
    }
}
?>