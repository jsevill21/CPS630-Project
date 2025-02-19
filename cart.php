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
$sql = "CREATE TABLE Cart (
cart_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
order_id INT(6) UNSIGNED NOT NULL,
item_id INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (order_id) REFERENCES Orders(order_id),
FOREIGN KEY (item_id) REFERENCES Item(item_id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Cart created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 