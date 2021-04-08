<?php
require_once("dbcontroller.php");

$connection = new Dbcontroller();
$conn = $connection -> get_connection();

if(isset($_POST["login_submit"])){
    // $username = $_POST["username"];
    // $password = $_POST["password"];
    // echo $username;
    // $sql = "SELECT users.email, users.password FROM users WHERE users.email = '".$_POST["username"]."'";
    $sql = "SELECT * FROM training.users WHERE first_name='Tony'";
    // $sql = 'SELECT name, color, calories FROM fruit ORDER BY name';
    foreach ($conn->query($sql) as $row) {
        print $row['first_name'] . "\t";
        // print $row['color'] . "\t";
        // print $row['calories'] . "\n";
    }
    // echo $sql."<br>";
    // $result = mysqli_query($conn, $sql);
    // $result = $conn->query($sql);
    // printf("Select returned %d rows.\n", $result->num_rows);
    // if (mysqli_num_rows($result) > 0) {
    // // output data of each row
    //     while($row = mysqli_fetch_assoc($result)) {
    //         echo "email: " . $row["email"]. "<br>";
    //         echo "password: " . $row["password"]. "<br>";
    //     }
    // } else {
    // echo "0 results";
    // }
    // if ($result = $mysqli -> query("SELECT * FROM Persons")) {
    //     echo "Returned rows are: " . $result -> num_rows;
    //     // Free result set
    //     $result -> free_result();
    // }
    // echo $username." ".$password;
}

?>