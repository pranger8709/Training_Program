<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");
    require_once("session.php");


    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();
    session_start();

    $sql = "SELECT users.user_id FROM users WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $user_id = $row["user_id"];
    }

    $weight = array();
    $date = array();
    $sql = "SELECT exercise_stats.weight, exercise_stats.date FROM exercise_stats JOIN exercise ON exercise_stats.exercise_id = exercise.exercise_id JOIN users ON exercise_stats.user_id = users.user_id WHERE exercise.name = 'Trap Raise' AND users.user_id = ".$user_id;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $x = (int)$row["weight"];
        
        $y = date('Y-m-d',strtotime($row["date"]));;
        $weight[] = $x;
        $date[] = $y;
    }

    // print_r($weight);
    print_r($date);

    // echo "<script>make_graph(".$x.", ".$y.")</script>";
?>

<html>
<head>
    <title>Exercise Stats</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="main.js"></script>
    <script src="plotly-latest.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
            </div>
            <h1 class="title">Exercise Stats</h1>
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
        <div id="tester" style="width:600px;height:250px;"></div>
        <script>
            var weight = <?php echo json_encode($weight);?>;
            var date = <?php echo json_encode($date);?>.map(Date);
            date = date.map(Date);
            console.log(date);
            // // function make_graph(x, y){
            // //     console.log(x);
            // //     console.log(y);
            TESTER = document.getElementById('tester');
            Plotly.newPlot( TESTER, [{
            x: date,
            y: weight }], {
            margin: { t: 0 } } );
        </script>
        <!-- <h3>Welcome to the Workout Training Program!</h3>
        <table class="main_page_table">
            <tr>
                <td>&ensp;&ensp;This is the place for those self-motivated individuals to want to train themseleves to be the best version of you. Whether you are just starting out on your journey or if you already track your progress another way we can help either way. To get started is free and really quite simple, create an account using you email address. Once you are regisitered you are able to generate a custom workout, if you do not like the workout generated you can either generate a new one or customize the current workout generated.</td>
            </tr>
            <tr>
                <td><img class="home_page_image" src="Style/Images/home-1.png"/></td>
            </tr>
        </table> -->
    </div>
</body>
</html>