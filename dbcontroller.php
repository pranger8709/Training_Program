<?php

class Dbcontroller{
    private $host = "localhost";
    private $dbname = "training_program";
    private $user = "tylerpranger";
    private $password = "";
    private $conn = NULL;

    function connect(){
        $this->conn = new PDO("pgsql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password);
        // $conn = new PDO('pgsql:host=localhost;dbname=training_program', 'tylerpranger','');
        if($this->conn === false){
            die("ERROR: Could not connect.");
        }
        return $this->conn;
    }

    function close_connection(){
        $this->conn = NULL;
    }
    // $this->conn = new PDO('pgsql:host=localhost;dbname=training_program', 'tylerpranger',''); 
}
?>