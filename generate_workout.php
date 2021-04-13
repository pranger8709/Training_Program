<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");
    require_once("session.php");


    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();
    session_start();

?>

<html>
<head>
    <title>Generate Workout</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="main.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
            </div>
            <h1 class="title">Generate Workout</h1>
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
        <!-- <h3>Welcome to the Workout Training Program!</h3>-->
        <table class="generate_page_table">
            <colgroup>
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 70%;">
            </colgroup>
            <tr>
                <td>
                    To generate a workout follow these simple steps
                    <ol style="text-align:left;">
                        <li>Select an area or areas to excersise</li>
                        <li>Click on generate</li>
                        <li>Modify the workout or keep it the same</li>
                        <li>Workout</li>
                        <li>Fill out your workout results</li>
                        <li>Save your workout</li>
                    </ol>
                </td>
                <td style="height:100%;vertical-align:baseline;">
                    <?php

                        // $sql = "SELECT * FROM exercise";

                        // $result = mysqli_query($conn, $sql);
                        // foreach($result as $row) {
                        //     print_r($row);
                        //     // do something with each row
                        // }
  
                    ?>
                    <form id="generate_workout_form" method="POST" autocomplete="off">
                        <label for="arms">Arms</label>
                        <input id="arms" type="checkbox" value="true">
                        <label for="chest">Chest</label>
                        <input id="chest" type="checkbox" value="true">
                        <label for="shoulder">Shoulder</label>
                        <input id="shoulder" type="checkbox" value="true">
                        <label for="leg">Legs</label>
                        <input id="leg" type="checkbox" value="true">
                        <label for="back">Back</label>
                        <input id="back" type="checkbox" value="true">
                        <label for="core">Core</label>
                        <input id="core" type="checkbox" value="true">
                        <input type="submit" id="generate_submit" name="generate_submit" value="Generate">
                    </form>
                </td>
            </tr>
        </table> 
    </div>
</body>
</html>