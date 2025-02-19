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
$sql = "CREATE TABLE Store (
store_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
store_name VARCHAR(50),
latitude FLOAT NOT NULL,
longitude FLOAT NOT NULL
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Store created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 