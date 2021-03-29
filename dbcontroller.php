<?php

class Dbcontroller{
    private $host = "localhost";
    private $dbname = "Training";
    private $user = "root";
    private $pwd = "root";
    // private $conn = NULL;

    function connect(){

        //MySQL DB Connection
        $conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->dbName);
        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $conn;

        //postgreSQL attempt
        // $this->conn = new PDO("pgsql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password);
        // // $conn = new PDO('pgsql:host=localhost;dbname=training_program', 'tylerpranger','');
        // if($this->conn === false){
        //     die("ERROR: Could not connect.");
        // }
    }

    function close_connection(){
        // $this->conn = NULL;
    }
    // $this->conn = new PDO('pgsql:host=localhost;dbname=training_program', 'tylerpranger',''); 
}
?>