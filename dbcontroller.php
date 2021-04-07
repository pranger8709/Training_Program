<?php

class Dbcontroller{
    private $host = "capstone.cubp1kd6anhq.us-east-1.rds.amazonaws.com";
    private $dbname = "training";
    private $user = "admin";
    private $pwd = "Unicorn2009!";

    protected function connect(){

        //MySQL DB Connection
        $conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->dbName);
        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $conn;
    }

    function get_connection(){
        return $this -> connect();
    }
    
    function close_connection($conn){
        $conn -> close();
    }
}
?>