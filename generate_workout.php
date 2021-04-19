<!DOCTYPE html>

<?php
    require_once("dbcontroller.php");
    require_once("session.php");


    $connection = new Dbcontroller();
    $conn = $connection -> get_connection();
    session_start();
    $exercise_list = array();
    
    if(isset($_POST["generate_submit"])){
        $arms = $_POST["arms"] ?? FALSE;
        $chest = $_POST["chest"] ?? FALSE;
        $shoulder = $_POST["shoulder"] ?? FALSE;
        $leg = $_POST["leg"] ?? FALSE;
        $core = $_POST["core"] ?? FALSE;
        $back = $_POST["back"] ?? FALSE;

        $sql = "";//complete sql script
        $list = array();


        if($arms){
            $sql = "SELECT exercise.name FROM exercise WHERE exercise.arm = 1";
        }

        if($chest){
            if($arms){
                $sql = $sql." OR exercise.chest = 1";
            }else{
                $sql = "SELECT exercise.name FROM exercise WHERE exercise.chest = 1";
            }
        }

        if($shoulder){
            if($chest || $arms){
                $sql = $sql." OR exercise.shoulder = 1";
            }else{
                $sql = "SELECT exercise.name FROM exercise WHERE exercise.shoulder = 1";
            }
        }

        // if($core){
        //     if($chest || $arms || $shoulder){
        //         $sql = $sql." OR exercise.core = 1";
        //     }else{
        //         $sql = "SELECT exercise.name FROM exercise WHERE exercise.shoulder = 1";
        //     }
        // }

        // if($back){
        //     if($chest || $arms || $shoulder || $core){
        //         $sql = $sql." OR exercise.core = 1";
        //     }else{
        //         $sql = "SELECT exercise.name FROM exercise WHERE exercise.shoulder = 1";
        //     }
        // }

        // if($leg){
        //     if($chest || $arms || $shoulder || $core || $back){
        //         $sql = $sql." OR exercise.leg = 1";
        //     }else{
        //         $sql = "SELECT exercise.name FROM exercise WHERE exercise.shoulder = 1";
        //     }
        // }
        
        if(!$arms && !$chest && !$shoulder && !$leg && !$core && !$back){
            echo "<script>window.onload = function() {remove_workout();};</script>";
        }else{
            echo "<script>window.onload = function() {display_workout();};</script>";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)) {
                array_push($list, $row['name']);
            }
            
            $GLOBALS["exercise_list"]= $list;
        } 
    }

    if(isset($_POST["submit_workout"])){
        // print_r($_POST["exercise"]);
        foreach($_POST["exercise"] as $i=>$exercise){
            $exercise_item = $_POST["exercise"];
            $sql = "SELECT users.user_id FROM users WHERE users.email = '".$_SESSION["uname"]."' and users.active = 1";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $user_id = $row["user_id"];
            }
            // echo "<br>".$user_id;

            $sql = "SELECT exercise.exercise_id FROM exercise WHERE exercise.name = '".$exercise_item[$i][0]."'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $exercise_id = $row["exercise_id"];
            }
            // echo "<br>".$exercise_id;
            // echo "<br>".$exercise_item[$i][0];

            // Insert the exercise set 1
            $sql = "INSERT INTO exercise_stats (exercise_stats.user_id, exercise_stats.exercise_id, exercise_stats.weight, exercise_stats.date)VALUES (".$user_id.",".$exercise_id.",".$exercise_item[$i][1].",NOW())";
            mysqli_query($conn, $sql);

            // Insert the exercise set 2
            $sql = "INSERT INTO exercise_stats (exercise_stats.user_id, exercise_stats.exercise_id, exercise_stats.weight, exercise_stats.date)VALUES (".$user_id.",".$exercise_id.",".$exercise_item[$i][2].",NOW())";
            mysqli_query($conn, $sql);

            // Insert the exercise set 3
            $sql = "INSERT INTO exercise_stats (exercise_stats.user_id, exercise_stats.exercise_id, exercise_stats.weight, exercise_stats.date)VALUES (".$user_id.",".$exercise_id.",".$exercise_item[$i][3].",NOW())";
            mysqli_query($conn, $sql);
            
        }
        echo "<script> window.onload = function() {update_workout_success();}; </script>";
        // echo "<script>window.onload = function() {remove_workout();};</script>";
    }

    function return_exercises(){
        return $GLOBALS["exercise_list"];
    }
?>

<html>
<head>
    <title>Generate Workout</title>
    <link rel="stylesheet" type="text/css" href="Style/theme.css" />
    <script src="jquery.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <header class="header">
        <div class="header_container">
            <div class="menu_icon_container">
                <img class="menu_icon" src="Style/Images/menu.svg" onclick="toggle_menu();"/>
                <?php
                    $first_name = $_SESSION['first_name'] ?? null;
                    if($first_name != null){
                        echo "<div style=\"padding-left: 5%;\">Hello, ".$_SESSION['first_name']."</div>";
                    } 
                ?>
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
                <td style="display:block;">
                    To generate a workout follow these simple steps
                    <ol style="text-align:left;">
                        <li>Select an area or areas to excersise</li>
                        <li>Click on generate</li>
                        <li>Modify the workout or keep it the same</li>
                        <li>Workout</li>
                        <li>Fill out your workout results</li>
                        <li>Save your workout</li>
                    </ol>
                    Want to see your progress? View your Exercise Stats here 
                </td>
                <td style="height:100%;vertical-align:baseline;">
                    <form id="generate_workout_form" method="POST" autocomplete="off">
                        <label for="arms">Arms</label>
                        <input id="arms" type="checkbox" name="arms" value="true">
                        <label for="chest">Chest</label>
                        <input id="chest" type="checkbox" name="chest" value="true">
                        <label for="shoulder">Shoulder</label>
                        <input id="shoulder" type="checkbox" name="shoulder" value="true">
                        <!-- <label for="leg">Legs</label>
                        <input id="leg" type="checkbox" name="leg" value="true"> -->
                        <!-- <label for="back">Back</label>
                        <input id="back" type="checkbox" name="back" value="true">
                        <label for="core">Core</label>
                        <input id="core" type="checkbox" name="core" value="true"> -->
                        <input type="submit" id="generate_submit" name="generate_submit" class="submit_button account_form_buttons" style="display: inline-block;" value="Generate">
                    </form>
                    <br>
                    <p id="update_success" class="success" style="display: block;width: 100%;visibility: hidden;">Workout Recorded Successfully</p>
                    <table id="workout_table" class="generate_page_table">
                    <form id="workout_form" method="POST" autocomplete="off">
                    <colgroup>
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 18.33%;">
                        <col span="1" style="width: 18.33%;">
                        <col span="1" style="width: 18.33%;">
                    </colgroup>
                        <tr id="workout_table_header">
                            <th>Exercise</th>
                            <th>Set 1</th>
                            <th>Set 2</th>
                            <th>Set 3</th>
                        </tr>
                    <?php
                        $exercise_list = return_exercises();
                        $exercise_used_list = array();

                        foreach($exercise_list as $i=>$exercise){
                            $y = get_new_index();
                            $exercise_list[$y] = $exercise_list[$y] ?? null;
                            echo "<tr>";
                            if($exercise_list[$y] != ""){
                                if($i <= 7){
                                    echo "<td><input type=\"hidden\" name=\"exercise[".$i."][0]\" value=\"".$exercise_list[$y]."\">".$exercise_list[$y]."</td>";
                                    echo "<td id=".$exercise_list[$y]."_set_1><input type=\"number\" name=\"exercise[".$i."][1]\" value=0></td>";
                                    echo "<td id=".$exercise_list[$y]."_set_2><input type=\"number\" name=\"exercise[".$i."][2]\" value=0></td>";
                                    echo "<td id=".$exercise_list[$y]."_set_3><input type=\"number\" name=\"exercise[".$i."][3]\" value=0></td>";
                                }else{
                                    break;
                                }
                            }else{
                                $exercise_list[$y] ?? null;
                            }
                            echo "</tr>";
                        }

                        function get_new_index(){
                            $y = array_rand($GLOBALS["exercise_list"]);
                            // print_r($GLOBALS["exercise_used_list"]);
                            if(in_array($y, $GLOBALS["exercise_used_list"])){
                                $y = 0;
                                get_new_index();
                            }else{
                                array_push($GLOBALS["exercise_used_list"], $y);
                                return $y;
                            }
                        }
                    ?>
                    <tr><td colspan="4" style="text-align: -webkit-center"><input id="submit_workout" type="submit" class="submit_button account_form_buttons" name="submit_workout" value="Submit Workout"/></td></tr>
                    </form>
                    </table>
                    <?php
                            // if(isset($_POST["submit_workout"])){
                            //     echo "<script> window.onload = function() {update_successful();}; </script>";
                            //     // echo "<script>window.onload = function() {remove_workout();};</script>";
                            //     // echo "hello";
                            // }
                    ?>
                    <!-- <tr id="update_success" class="success"><td>Workout Submitted</td></tr> -->
                </td>
            </tr>
        </table> 
    </div>
</body>
</html>