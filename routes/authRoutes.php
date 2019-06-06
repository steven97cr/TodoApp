<?php
    require_once(__DIR__."/../ln/lnAuth.php");
    $lnAuth = new lnAuth();

    if(isset($_GET['action'])){

        switch($_GET['action']){
    
            case "login":
                exit(json_encode($lnAuth -> login()));
                break;
    
            case "logout":
                $lnAuth -> logout();
                break;
    
        }
    
    }
?>