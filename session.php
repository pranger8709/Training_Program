<?php
    require_once("dbcontroller.php");
    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();

    function set_session($username){
        $_SESSION['uname'] = $username;
    }

    function set_session_name($first_name){
        $_SESSION['first_name'] = $first_name;
    }
?>