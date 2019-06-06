<?php
    require_once(__DIR__."/../ln/lnTasks.php");
    $lnTasks = new lnTasks();

    if(isset($_POST['action'])){

        switch($_POST['action']){
    
            case "addTask":
                exit(json_encode($lnTasks -> addTask($_POST)));
                break;
            
            case "deleteTask":
                exit(json_encode($lnTasks -> deleteTask($_POST)));
                break;
    
            case "editTask":
                exit(json_encode($lnTasks -> editTask($_POST)));
                break;
    
            case "getTask":
                exit(json_encode($lnTasks -> getTask($_POST)));
                break;
            
            case "getTasks":
                exit(json_encode($lnTasks -> getTasks($_POST)));
                break;
    
        }
    
    }
?>