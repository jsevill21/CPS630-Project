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
$sql = "CREATE TABLE Orders (
order_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
trip_id INT(6) UNSIGNED NOT NULL,
payment_id INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (trip_id) REFERENCES Trip(trip_id),
FOREIGN KEY (payment_id) REFERENCES Payment(payment_id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Orders created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
