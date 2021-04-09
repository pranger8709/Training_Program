<?php
    require_once("dbcontroller.php");
    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();

   if(isset($_POST["register_submit"])){
        $sql = "INSERT INTO training.users (users.first_name, users.last_name, users.email, users.password, users.date, users.active) VALUES ('".$_POST["first_name"]."','".$_POST["last_name"]."','".$_POST["email"]."','".$_POST["password"]."', NOW(), '1')";
        echo $sql;
        mysqli_query($conn, $sql);
        session_start();
        $_SESSION['uname'] = $_POST["email"];
        header('Location: home.php');
    }
?>