<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "osp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$name = $_POST['name'];
$price = $_POST['price'];

$sql = "INSERT INTO Item (item_name, price) VALUES (." $name . "," . $price . ")";

if (mysqli_multi_query($conn, $sql)) {
    echo "Record created successfully";
} else {
    echo "Error" .$sql. "<br>" .$conn->error;
}

$conn->close();
?>