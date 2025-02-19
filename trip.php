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
$sql = "CREATE TABLE Trip (
trip_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
truck_id INT(6) UNSIGNED NOT NULL,
destination VARCHAR(50) NOT NULL,
FOREIGN KEY (truck_id) REFERENCES Truck(truck_id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Trip created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 