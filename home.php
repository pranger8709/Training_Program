<?php
    require_once("dbcontroller.php");


    $connection = new Dbcontroller();
    $conn = $connection -> connect();

    $sql = 'SELECT first_name FROM users';
    foreach ($conn->query($sql) as $row) {
        print $row['first_name'] . "\n";
    }
    $connection -> close_connection();
?>

<html>
<head>
</head>
<body>
    <form method="get">
        <label for="fname">First name:</label>
        <input type="text" id="fname" name="fname"><br><br>
        <label for="lname">Last name:</label>
        <input type="text" id="lname" name="lname"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>