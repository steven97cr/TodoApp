<?php
require_once(__DIR__.'/connection.php');
class dbTasks extends Connection{

    function __construct(){
        parent::__construct();
    }

    function addTask($newTask){
        extract($newTask);
        $query = "call spAddTask($userID,'$taskTitle','$taskBody',$taskPriority);";
        $data = $this -> fetchQuery($query);
        return $data[0];
    }

    function getTask($taskID){
        $query = "call spGetTask($taskID);";
        $data = $this -> fetchQuery($query);
        return $data[0];
    }

    function getTasks($userID){
        $query = "call spGetTasks($userID);";
        $data = $this -> fetchQuery($query);
        return $data;
    }

    function editTask($taskID,$editedTask){
        extract($editedTask);
        $query = "call spEditTask($taskID,'$taskTitle','$taskBody',$taskPriority);";
        $data = $this -> fetchQuery($query);
        return $data[0];
    }

    function deleteTask($taskID){
        $query = "call spDeleteTask($taskID);";
        return $this -> query($query);
        
    }
}
?>