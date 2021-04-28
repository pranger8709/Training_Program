<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");
    require_once("session.php");
    date_default_timezone_set('MST');

    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();
    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");
    session_start();

    $weight = array();
    $date = array();
    
    

    if(isset($_POST["generate_results"])){

        // Getting the user id TODO: Make this a universal function so that this is not repeated
        $sql = "SELECT users.user_id FROM users WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            $user_id = $row["user_id"];
        }

        //Getting the data back for dates and weights into the x and y, for graphing
        $sql = "SELECT exercise_stats.weight, exercise_stats.date FROM exercise_stats JOIN exercise ON exercise_stats.exercise_id = exercise.exercise_id JOIN users ON exercise_stats.user_id = users.user_id WHERE exercise.name = '".$_POST["exercise"][0]."' AND users.user_id = ".$user_id;
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $x = (int)$row["weight"];
            $y = $row["date"];
            $weight[] = $x;
            $date[] = $y;
        }
    }else{
        // unset($_REQUEST);  
        // unset($_POST);
    }
    
    // unset($_POST["generate_results"]);

    
?>

<html>
<head>
    <title>Exercise Stats</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="plotly-latest.min.js"></script>
    <script src="jquery.js"></script>
    <script src="main.js"></script>
    
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
            <h2 class="title">Exercise Stats</h2>
            <div class="logo_icon_container">
                <a href="home.php"><img class="logo" src="Style/Images/logo.png"/></a>
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
        <table style="display:inline-block;width:30%;">
            <tr style="text-align:left">
                <td>
                    <p>Finding out what your results are for each exercise is just a few button clicks away. Follow the instructions below and find out how you are doing.</p>
                    <h3 style="text-align:center">Instructions</h3>
                    <ol>
                        <li>Select a area of the body</li>
                        <li>Select an exercise</li>
                        <li>Click on submit</li>
                        <li>See your results</li>
                        <li>Repeat!</li>
                    </ol>
                    <p>Don't be alarmed if you do not see the progress that you want. Here are a few tips to get you back on track.</p>
                    <ul style="list-style-type:circle;">
                        <li>Plateau: Introduce some alternative exercises and alter your diet. It could very well be that your body isn't getting enough protien to build your muscle.</li>
                        <li>Scattered: If there isn't a pattern with your progress it very well could be that your workouts are not consistent. Stay consistent all the way through and you will start seeing patterens.</li>
                        <li>Decline: This could be several things: diet, workout routine, or even an illness like the cold or flu. A lot of atheltes experience this at some point and it requires a bit of patience and dedication to see your trends start to increase.</li>
                        <li>Increse: Don't stop what you are doing. Keep up the good work and keep with it.</li>
                    </ul>
                </td>
            </tr>
        </table>
        <table style="float:right;width:70%;height:100%;">
            <tr style="height:15%;width:100%;">
                <td style="height: 100%;position: relative;display: block;margin-left: auto;margin-right: auto;">
                <form style="margin-top:0%;" method="POST">
                <select id="area" name="area" onchange=show_exercises();>
                        <!--Here we are displaying the opions to select the body area to display the correct workouts later-->
                        <option value="">Select One</option>
                        <option value="arms">Arms</option>
                        <option value="chest">Chest</option>
                        <option value="shoulder">Shoulders</option>
                        <option value="leg">Legs</option>
                        <option value="back">Back</option>
                        <option value="core">Core</option>
                    </select>
                <br>
                
                <?php
                    // Each div will have display none until the user selects the body area then it will display and hide the others
                    echo "<div id=\"arms\" style=\"display:none;\">";
                        $arm_sql = "SELECT exercise.name FROM exercise WHERE exercise.arm = 1 and exercise.active = 1"; 
                        $arm_result = mysqli_query($conn, $arm_sql );
                        while($row = mysqli_fetch_assoc($arm_result)) {
                            echo "<label id=\"arm_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"arm\" type=\"radio\" value=\"".$row["name"]."\" name=\"exercise[]\">";
                        }
                    echo "</div>";
                    echo "<div id=\"chest\" style=\"display:none;\">";
                        $chest_sql = "SELECT exercise.name FROM exercise WHERE exercise.chest = 1 and exercise.active = 1"; 
                        $chest_result = mysqli_query($conn, $chest_sql );
                        while($row = mysqli_fetch_assoc($chest_result)) {
                            echo "<label id=\"chest_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"chest_input\" type=\"radio\" value=\"".$row["name"]."\" name=\"exercise[]\">";
                        }
                    echo "</div>";
                    echo "<div id=\"shoulder\" style=\"display:none;\">";
                        $chest_sql = "SELECT exercise.name FROM exercise WHERE exercise.shoulder = 1 and exercise.active = 1"; 
                        $chest_result = mysqli_query($conn, $chest_sql );
                        while($row = mysqli_fetch_assoc($chest_result)) {
                            echo "<label id=\"chest_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"chest_input\" type=\"radio\" value=\"".$row["name"]."\" name=\"exercise[]\">";
                        }
                    echo "</div>";
                    echo "<div id=\"leg\" style=\"display:none;\">";
                        $chest_sql = "SELECT exercise.name FROM exercise WHERE exercise.leg = 1 and exercise.active = 1"; 
                        $chest_result = mysqli_query($conn, $chest_sql );
                        while($row = mysqli_fetch_assoc($chest_result)) {
                            echo "<label id=\"chest_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"chest_input\" type=\"radio\" value=\"".$row["name"]."\" name=\"exercise[]\">";
                        }
                    echo "</div>";
                    echo "<div id=\"back\" style=\"display:none;\">";
                        $chest_sql = "SELECT exercise.name FROM exercise WHERE exercise.back = 1 and exercise.active = 1"; 
                        $chest_result = mysqli_query($conn, $chest_sql );
                        while($row = mysqli_fetch_assoc($chest_result)) {
                            echo "<label id=\"chest_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"chest_input\" type=\"radio\" value=\"".$row["name"]."\" name=\"exercise[]\">";
                        }
                    echo "</div>";
                    echo "<div id=\"core\" style=\"display:none;\">";
                        $chest_sql = "SELECT exercise.name FROM exercise WHERE exercise.core = 1 and exercise.active = 1"; 
                        $chest_result = mysqli_query($conn, $chest_sql );
                        while($row = mysqli_fetch_assoc($chest_result)) {
                            echo "<label id=\"chest_label\" for=\"".$row["name"]."\">".$row["name"]."</label>";
                            echo "<input id=\"chest_input\" type=\"radio\" value=\"".$row["name"]."\" name=\"exercise[]\">";
                        }
                    echo "</div>";
                ?>
                    <input type="submit" id="generate_submit" name="generate_results" class="submit_button account_form_buttons">   
                </form>
                </td>
            </tr>
            <tr >
                <?php
                    $exercise = $_POST["exercise"][0] ?? null;
                    if($exercise != null){
                        echo "<td id=\"graph_heading\" style=\"height:2%;width:100%;\"><h3>Exercise: ".$exercise."</h3></td>";
                    }else{
                        echo "<td id=\"graph_heading\" style=\"height:2%;width:100%;\">Select an excercise to see the results</td>";
                    }
                   
                ?>
            </tr>
            <tr >
                <td id="graph" style="height:83%;width:100%;"></td>
            </tr>
        </table>
    </div>
</body>
</html>


<script>
    //  This is where the magic happens for the graphing
        var weight = <?php echo json_encode($weight);?>;
        var date = <?php echo json_encode($date);?>;
        var data = [{x:date, y:weight, type:"scatter"}];
        var layout = {showlegend: false,xaxis: {rangemode: 'tozero',autorange: true},yaxis: {rangemode: 'tozero',autorange: true}};
        Plotly.newPlot('graph', data, layout);   
</script>