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
$sql = "INSERT INTO Store (store_name, latitude, longitude) VALUES ('Square One', 43.593, -79.6426);";
$sql .= "INSERT INTO Store (store_name, latitude, longitude) VALUES ('Yorkdale', 43.7256, -79.4527);";

if ($conn->multi_query($sql)) {
    echo "Records inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>