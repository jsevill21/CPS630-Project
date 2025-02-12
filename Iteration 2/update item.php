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
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

$sql = "UPDATE Item SET name=" . $name . "," . "price=" . $price . " WHERE id=" . $id;

if (mysqli_multi_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error" .$sql. "<br>" .$conn->error;
}

$conn->close();
?>