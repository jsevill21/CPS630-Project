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

$sql = "DELETE FROM Item WHERE id=" . $id;

if (mysqli_multi_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error" .$sql. "<br>" .$conn->error;
}

$conn->close();
?>