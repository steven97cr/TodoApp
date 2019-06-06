<?php
    require_once(__DIR__."/../ln/lnUsers.php");
    $lnUsers = new lnUsers();

    if(isset($_POST['action'])){

        switch($_POST['action']){
    
            case "addUser":
                exit(json_encode($lnUsers -> addUser($_POST)));
                break;
    
            case "getUser":
                exit(json_encode($lnUsers -> getUser($_POST)));
                break;
    
            case "editUser":
                exit(json_encode($lnUsers -> editUser($_POST)));
                break;
    
        }
    
    }
?>