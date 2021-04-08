<?php
    require_once("dbcontroller.php");
    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();


    if(isset($_POST["login_submit"])){
        $username = $_POST["username"];
        // // $password = $_POST["password"];
        // // echo $username;
        $sql = "SELECT users.email, users.password FROM users WHERE users.email = '".$_POST["username"]."' and users.active = 1";
        // // echo $sql."<br>";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // echo "email: " . $row["email"]. "<br>";
                if($row['password'] == $_POST["password"]){
                    // $session -> get_session($username);
                    session_start();
                    $_SESSION['uname'] = $username;
                    header('Location: home.php');
                    // echo $_SESSION['username'];
                    // echo "password: " . $row["password"]. "<br>";
                }
                
            }
        } else {
            echo "0 results";
        }
    }
?>