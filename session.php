<?php
    require_once("dbcontroller.php");
    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();

    //setting the session username
    function set_session($username){
        $_SESSION['uname'] = $username;
    }

    //setting the session first name
    function set_session_name($first_name){
        $_SESSION['first_name'] = $first_name;
    }
?>