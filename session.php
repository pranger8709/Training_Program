<?php
    require_once("dbcontroller.php");
    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();

    function set_session($username){
        $_SESSION['uname'] = $username;
    }
?>