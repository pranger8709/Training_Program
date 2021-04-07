<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");

    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();

    if(isset($_POST["login_submit"])){
        // $username = $_POST["username"];
        // $password = $_POST["password"];
        // echo $username;
        $sql = "SELECT users.email, users.password FROM training.users WHERE users.email = '".$_POST["username"]."'";
        // echo $sql;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "email: " . $row["email"]. "<br>";
                echo "password: " . $row["password"]. "<br>";
            }
        } else {
        echo "0 results";
        }
        // if ($result = $mysqli -> query("SELECT * FROM Persons")) {
        //     echo "Returned rows are: " . $result -> num_rows;
        //     // Free result set
        //     $result -> free_result();
        // }
        // echo $username." ".$password;
    }
?>

<html>
<head>
    <title>Training - Account</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="main.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
            </div>
            <h1 class="title">Login/Register</h1>
            <div class="menu_icon_container">
                <img class="logo" src="Style/Images/logo.png"/>
            </div>
        </div>
    </header>
    <div class="main_body">
        <!-- The Modal -->
        <div id="modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" onclick="close_modal_login();">&times;</span>
            <div id="login_page" class="login_page">
                <form id="login_form" method="POST" class="account_forms" autocomplete="off">
                <table style="margin: auto;">
                    <tr>
                        <td><h1 style="color:white;">Login</h1></td>
                    </tr>
                    <tr>
                        <td><input name="username" placeholder="Email" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input name="password" placeholder="Password" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="submit_button account_form_buttons" name="login_submit"/></td>
                    </tr>
                </table>
                </form>
            </div>
            <div id="register_page" class="login_page">
                <form id="register_form" method="POST" class="account_forms" autocomplete="off">
                <table style="margin: auto;">
                    <tr>
                        <td><h1 style="color:white;">Register</h1></td>
                    </tr>
                    <tr>
                        <td><input placeholder="First Name" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input placeholder="Last Name" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input type="email" placeholder="Email" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Password" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Confirm Password" class="account_form_buttons"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="submit_button account_form_buttons"/></td>
                    </tr>
                </table>
                </form>
            </div>
        </div>

        </div>
        <div id="menu" onmouseleave="mouse_toggle_menu();">
            <a href="home.php"><div class="menu_item">Home</div></a>
            <a href="account.php"><div class="menu_item">Login/Register</div></a>
        </div>
        <p style="width:60%;margin-left:auto;margin-right:auto;text-align:left;">
            To create an account please click on "Register" to begin your journey, don't worry its quick and easy. Otherwise if you are a returning customer just login and start working out.
        </p>
        <table style="height:50%;width:100%;vertical-align:middle;position:fixed">
            <tr>
                <td><button id="login" class="account_buttons" onclick="open_modal_login();">Login</button></td>
            </tr>
            <tr>
                <td><button id="register" class="account_buttons" onclick="open_modal_register();">Register</button></td>
            </tr>
        </table> 
    </div>
</body>
</html>