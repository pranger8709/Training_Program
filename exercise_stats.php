<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");
    require_once("session.php");
    date_default_timezone_set('MST');

    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();
    session_start();

    $weight = array();
    $date = array();
    // $area_type = null;
   

    if(isset($_POST["generate_results"])){
        $sql = "SELECT users.user_id FROM users WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $user_id = $row["user_id"];
        }
        $sql = "SELECT exercise_stats.weight, exercise_stats.date FROM exercise_stats JOIN exercise ON exercise_stats.exercise_id = exercise.exercise_id JOIN users ON exercise_stats.user_id = users.user_id WHERE exercise.name = 'Trap Raise' AND users.user_id = ".$user_id;
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $x = (int)$row["weight"];
            $y = $row["date"];
            $weight[] = $x;
            $date[] = $y;
        }

        // print_r($weight);
        // print_r($date);
        
        // $simple_weight[] = echo json_encode($weight);
        // echo "<script src=\"main.js\">create_visual_graph(".json_encode($weight).",".json_encode($date).");</script>";
        // echo "<script>create_visual_graph();</script>";
    }
    
?>

<html>
<head>
    <title>Exercise Stats</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="plotly-latest.min.js"></script>
    <script src="jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    <script src="main.js"></script>
    
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

        <!-- <h3>Welcome to the Workout Training Program!</h3> -->
        <!-- <table class="main_page_table"> -->
        <table class="generate_page_table">
            <colgroup>
                <col span="1" style="width: 100%;">
                <!-- <col span="1" style="width: 70%;"> -->
            </colgroup>
            <tr>
                <td>
                <form style="height:100%" method="POST">
                <select id="area" name="area" onchange=show_exercises();>
                        <option value="">Select One</option>
                        <option value="arms">Arms</option>
                        <option value="chest">Chest</option>
                        <option value="shoulder">Shoulders</option>
                    </select>
                <br>
                
                <?php
                    
                // $GLOBALS["area_type"] = $_POST["area"];
                echo "<div id=\"select_exercise\">";
                    // echo $GLOBALS["part_type"];
                    // if($area == "arms"){
                    echo "<div id=\"arms\" style=\"display:none;\">";
                        $arm_sql = "SELECT exercise.name FROM exercise WHERE exercise.arm = 1 and exercise.active = 1"; 
                        $arm_result = mysqli_query($conn, $arm_sql );
                        while($row = mysqli_fetch_assoc($arm_result)) {
                            echo "<label id=\"arm_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"arm\" type=\"radio\" value=\"".$row["name"]."\" name=\"".$row["name"]."\">";
                        }
                    echo "</div>";
                    echo "<div id=\"chest\" style=\"display:none;\">";
                        $chest_sql = "SELECT exercise.name FROM exercise WHERE exercise.chest = 1 and exercise.active = 1"; 
                        $chest_result = mysqli_query($conn, $chest_sql );
                        while($row = mysqli_fetch_assoc($chest_result)) {
                            echo "<label id=\"chest_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"chest_input\" type=\"radio\" value=\"".$row["name"]."\" name=\"".$row["name"]."\">";
                        }
                    echo "</div>";
                    // }
                echo "</div>";
                ?>
                
                    <input type="submit" id="generate_submit" name="generate_results" class="submit_button account_form_buttons">   
                </form>
                </td>
            </tr>
            <tr>
                <td id="graph" style="display:inline-block"></td>
            </tr>
        </table>
        
            <!-- <div id="tester" style="width:600px;height:250px;"></div> -->
 
            <!-- <tr>
                <td>&ensp;&ensp;This is the place for those self-motivated individuals to want to train themseleves to be the best version of you. Whether you are just starting out on your journey or if you already track your progress another way we can help either way. To get started is free and really quite simple, create an account using you email address. Once you are regisitered you are able to generate a custom workout, if you do not like the workout generated you can either generate a new one or customize the current workout generated.</td>
            </tr>
            <tr>
                <td><img class="home_page_image" src="Style/Images/home-1.png"/></td>
            </tr> -->
        <!-- </table> -->
    </div>
</body>
</html>


<script>
    // function create_visual_graph(){
        var weight = <?php echo json_encode($weight);?>;
        var date = <?php echo json_encode($date);?>;
        // console.log(date);

        var data = [{x:date, y:weight, type:"line"}];
        var layout = {showlegend: false,xaxis: {rangemode: 'tozero',autorange: true},yaxis: {rangemode: 'tozero',autorange: true}};
        Plotly.newPlot('graph', data, layout);
    // }
                
</script>