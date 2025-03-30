<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "osp";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {

    error_log("MySQL connection error: " . $conn->connect_error);
    

    die("<p style='color:red;'> Connection failed: " . $conn->connect_error . "</p>");
} else {

    echo "<p style='color:green;'> Connected to database '$dbname' successfully!</p>";
}
?>
