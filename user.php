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
$sql = "CREATE TABLE User (
email VARCHAR(50) PRIMARY KEY,
salt VARCHAR(80) NOT NULL,
password VARCHAR(100) NOT NULL,
delivery_address VARCHAR(50) NOT NULL
);";

if (mysqli_query($conn, $sql)) {
    echo "Table User created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
