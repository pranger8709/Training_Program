<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");
    require_once("session.php");


    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();
    session_start();

    $sql = "SELECT * FROM users WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
        
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $email = $row["email"];
    }

    if(isset($_POST["submit_change"])){
        // echo '<script type="text/JavaScript"> update_successful();</script>';



        if($_POST["first_name"] != "" && $_POST["first_name"] != $first_name){
            $sql = "UPDATE users SET users.first_name = '".$_POST["first_name"]."' WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
            $result = mysqli_query($conn, $sql);
        }

        if($_POST["last_name"] != "" && $_POST["last_name"] != $last_name){
            $sql = "UPDATE users SET users.last_name = '".$_POST["last_name"]."' WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
            $result = mysqli_query($conn, $sql);
        }

        if($_POST["email"] != "" && $_POST["email"] != $email){
            $sql = "UPDATE users SET users.email = '".$_POST["email"]."' WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
            $result = mysqli_query($conn, $sql);
            $_SESSION["uname"] = $_POST["email"];
        }

        if($_POST["password"] != "" && $_POST["confirm_password"] != ""){
            $sql = "UPDATE users SET users.password = '".$_POST["password"]."' WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
            $result = mysqli_query($conn, $sql);
        }
        // header('Location: account_settings.php');


        $sql = "SELECT * FROM users WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
        }
        if($_POST["password"] != "" && $_POST["confirm_password"] != "" && $_POST["password"] == $_POST["confirm_password"]){
            echo "<script> window.onload = function() {update_successful();}; </script>";//after the script has run it will display the successful message
        }
        
    }

    if(isset($_POST["submit_deactivate"])){
        $sql = "UPDATE users SET users.active = 0 WHERE users.email = '".$_SESSION["uname"]."'";
        $result = mysqli_query($conn, $sql);
        unset($_SESSION['uname']);
        session_destroy(); 
        header('Location: home.php');
    }
?>

<html>
<head>
    <title>Account Settings</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="main.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
            </div>
            <h1 class="title">Account Settings</h1>
            <div class="menu_icon_container">
                <img class="logo" src="Style/Images/logo.png"/>
            </div>
        </div>
    </header>
    <div class="main_body">
        <div id="menu" onmouseleave="mouse_toggle_menu();">
            <a href="home.php"><div class="menu_item">Home</div></a>
            <?php
            if(!isset($_SESSION['uname'])){
                echo "<a href=\"account.php\"><div class=\"menu_item\">Login/Register</div></a>";
            }else{
                echo "<a href=\"account_settings.php\"><div class=\"menu_item\">Account Settings</div></a>";
                echo "<a href=\"generate_workout.php\"><div class=\"menu_item\">Generate Workout</div></a>";
                echo "<a href=\"exercise_stats.php\"><div class=\"menu_item\">Exercise Stats</div></a>";
                echo "<a href=\"logout.php\" id=\"logout\"><div class=\"menu_item\">Logout</div></a>";
                
            }
            ?>
        </div>
        <div>
            <form id="register_form" method="POST" class="account_forms" autocomplete="off" onsubmit="return validate_change_passwords();">
                <table style="margin: auto;">
                    <tr>
                        <td><p>Change your account information or deacivate your account. Please know that once you deactivate your account your data will be lost.</p></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                echo "<input placeholder=\"First Name\" class=\"account_form_buttons\" name=\"first_name\" value=$first_name required/>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                echo "<input placeholder=\"Last Name\" class=\"account_form_buttons\" name=\"last_name\" value=$last_name required/>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                echo "<input type=\"email\" placeholder=\"Email\" class=\"account_form_buttons\" name=\"email\" value=$email required/>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Password" class="account_form_buttons" name="password"/></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Confirm Password" class="account_form_buttons" name="confirm_password"/></td>
                    </tr>
                    <tr>
                        <td>
                            <input id="submit_change" type="submit" class="submit_button account_form_buttons" name="submit_change" value="Submit Changes"/>
                        </form>
                        <form id="deacitvate_form" method="POST" style="display:inline-block;">
                            <input type="submit" class="submit_button account_form_buttons" name="submit_deactivate" value="Deactivate"/>
                        </form>
                        </td>
                    </tr>
                    <tr id="update_success" class="success"><td>Update Successful</td></tr>
                    <tr id="register_failed" class="warning"><td>Passwords Do Not Match</td></tr>
                </table>
                <!-- </form> -->
            </div>
        </div>
    </div>
</body>
</html>