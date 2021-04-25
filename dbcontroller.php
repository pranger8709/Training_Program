<?php

class Dbcontroller{
    private $host = "capstone.cubp1kd6anhq.us-east-1.rds.amazonaws.com";
    private $dbname = "training";
    private $user = "admin";
    private $pwd = "Unicorn2009!";

    protected function connect(){
        //Connecting to the MySQL DB using the mysqli
        $conn = mysqli_connect($this->host, $this->user, $this->pwd, "training", 3306);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $conn;
    }

    function get_connection(){
        //returning the connection for the pages to use
        return $this -> connect();
    }
    
    function close_connection($conn){
        //closing the connection
        $conn -> close();
    }
}
?>