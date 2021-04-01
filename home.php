<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");


    $connection = new Dbcontroller();
    $conn = $connection -> connect();

    // $sql = 'SELECT first_name FROM users';
    // foreach ($conn->query($sql) as $row) {
    //     print $row['first_name'] . "\n";
    // }
    // $connection -> close_connection();
?>

<html>
<head>
    <title>Training</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="main.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
            </div>
            <h1 class="title">Training Program</h1>
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
        <h3>Welcome to the Workout Training Program!</h3>
        <table class="main_page_table">
            <tr>
                <td>&ensp;&ensp;This is the place for those self-motivated individuals to want to train themseleves to be the best version of you. Whether you are just starting out on your journey or if you already track your progress another way we can help either way. To get started is free and really quite simple, create an account using you email address. Once you are regisitered you are able to generate a custom workout, if you do not like the workout generated you can either generate a new one or customize the current workout generated.</td>
            </tr>
            <tr>
                <td><img class="home_page_image" src="Style/Images/home-1.png"/></td>
            </tr>
        </table>
    </div>
</body>
</html>