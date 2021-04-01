<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");

    $connection = new Dbcontroller();
    $conn = $connection -> connect();
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
        <div id="menu" onmouseleave="mouse_toggle_menu();">
            <a href="home.php"><div class="menu_item">Home</div></a>
            <a href="account.php"><div class="menu_item">Login/Register</div></a>
        </div>
        <p style="width:60%;margin-left:auto;margin-right:auto;text-align:left;">
            To create an account please click on "Register" to begin your journey, don't worry its quick and easy. Otherwise if you are a returning customer just login and start working out.
        </p>
        <table style="height:50%;width:100%;vertical-align:middle;position:fixed">
            <tr>
                <td><button class="account_buttons">Login</button></td>
            </tr>
            <tr>
                <td><button class="account_buttons">Register</button></td>
            </tr>
        </table> 
    </div>
</body>
</html>