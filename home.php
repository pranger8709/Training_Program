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
    <title>Training</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="JavaScript/jquery.min.js"></script>
    <script src="JavaScript/main.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
                <?php
                //If the user is logged in then it will display the first name of the user, otherwise nothing will happen
                    $first_name = $_SESSION['first_name'] ?? null;
                    if($first_name != null){
                        echo "<div style=\"padding-left: 5%;\">Hello, ".$_SESSION['first_name']."</div>";
                    } 
                ?>
            </div>
            <h2 class="title">Home</h2>
            <div class="logo_icon_container">
                <a href="home.php"><img class="logo" src="Style/Images/logo.png"/></a>
            </div>
        </div> 
    </header>
    <div class="main_body">
        <div id="menu" onmouseleave="mouse_toggle_menu();">
            <a href="home.php"><div class="menu_item">Home</div></a>
            <?php
            //This is checking if the username is not null and if not it will change Login/Register to Logout as well as dispaly the other 4 menu items
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
        <h3>Welcome to the Workout Training Program!</h3>
        <table class="main_page_table">
            <colgroup>
                <col span="1" style="width: 33.33%;">
                <col span="1" style="width: 33.33%;">
                <col span="1" style="width: 33.33%;">
            </colgroup>
            <tr>
                <td class="home_table_data">
                    <h3>What?</h3>
                    <p>You might be wondering, "What is this?" and "What can it do for me?" Both are great questions. This program is designed for those who don't want to spend mony on a fitness tracker that may not meet your needs.</p>
                    <p>Most applications that are out there try to sell you things you may not need. To be effective with your fitness you need to be motivated and the best way to do that is to track your progress as you go.</p>
                </td>
                <td class="home_table_data">
                    <h3>How?</h3>
                    <p>So how can we help you? Well its simple we provide a safe and productive way to allow you to track your fitness progress.</p>
                    <p>In the program you will be able to generate a workout based on the areas that you would like to focus on such as Arms, Legs, and even your Core and Back.</p>
                    <p>Once you have entered your stats for that workout just head over to the exercise stats page and see your results per exercise.</p>
                </td>
                <td class="home_table_data">
                    <h3>Why?</h3>
                    <p>We all start at some point. Whether it's your first time working out or if you are starting back up. Tracking your fitness progress is key to see the results you want.</p>
                    <p>Just remember you may not see results right away, and that it is expected. </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"><img class="home_page_image" src="Style/Images/home-1.png"/></td>
            </tr>
        </table>
    </div>
    <?php
        include("footer.php");
    ?>
</body>
</html>