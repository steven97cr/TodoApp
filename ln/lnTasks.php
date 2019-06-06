<?php
require_once(__DIR__."/../db/dbTasks.php");
class lnTasks{

    var $dbTasks; 

    function __construct(){
        $this -> dbTasks = new dbTasks();
    }

    function addTask($newTask){
        return $this -> dbTasks -> addTask($newTask);
    }

    function getTasks($idUser){
        return $this -> dbTasks -> getTasks($idUser);
    }
}
?>