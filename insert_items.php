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
$sql = "INSERT INTO Items (item_name, price) VALUES ('iPad', 100);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('Huawei Laptop MateBook', 900);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('Microsoft Surface Laptop', 270);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('Samsung Tablet', 110);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('iPhone', 400);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('Sony WH-1000XM5 Headphones', 400);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('Sonos Era 100 Smart Speaker', 250);";
$sql .= "INSERT INTO Items (item_name, price) VALUES ('Google Pixel 8a', 600);";

if ($conn->multi_query($sql)) {
    echo "Records inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>