<?php
class Connection{

    var $data;
    var $con;
    var $result;
    
    function __construct(){

        $this -> data = array(
            'user'  => 'root',
            'pass'  => '',
            'host'  => 'localhost',
            'db'    => 'dbToDoApp'
        );

    }

    function connect(){

        $this -> con = mysqli_connect(
            $this -> data['host'],
            $this -> data['user'],
            $this -> data['pass'],
            $this -> data['db']
        );

    }

    function disconnect(){

        mysqli_close($this -> con);
        mysqli_free_result($this -> result);

    }

    function query($sql){

        $this -> connect();
        $this -> result = mysqli_query($this -> con, $sql);

        if($this -> result){

            return array(
                'rows'    => $this -> result,
                'error'     => false 
            );

        }else{

            return array(
                'rows'    => null,
                'error'     => mysqli_error($this -> con) 
            );

        }

    }

    function fetchQuery($sql){

        $result = $this -> query($sql);
        $rows = array();

        if($result['rows']){

            while($row = mysqli_fetch_array($result['rows'])){

                $rows[] = $row;

            }

        }

        return $rows;

    }
}
?>