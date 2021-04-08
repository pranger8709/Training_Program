<?php

class Dbcontroller{
    private $host = "capstone.cubp1kd6anhq.us-east-1.rds.amazonaws.com";
    private $dbname = "training";
    private $user = "admin";
    private $pwd = "Unicorn2009!";

    protected function connect(){

        //MySQL DB Connection $_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']
        $conn = new mysqli($_SERVER[$this->host], $_SERVER[$this->user], $_SERVER[$this->pwd], $_SERVER[$this->dbName], $_SERVER[3306]);
        // $conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->dbName, 3306);
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