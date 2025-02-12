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
$sql = "INSERT INTO Item (id, item_name, price, department_code) VALUES (1, 'iPad', 100, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (2, 'Huawei Laptop MateBook', 900, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (3, 'Microsoft Surface Laptop', 270, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (4, 'Samsung Tablet', 110, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (5, 'iPhone', 400, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (6, 'Sony WH-1000XM5 Headphones', 400, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (7, 'Sonos Era 100 Smart Speaker', 250, 1);";
$sql .= "INSERT INTO Item (id, item_name, price, department_code) VALUES (8, 'Google Pixel 8a', 600, 1);";

if (mysqli_multi_query($conn, $sql)) {
    echo "Records created successfully";
} else {
    echo "Error" .$sql. "<br>" .$conn->error;
}

$conn->close();
?>
