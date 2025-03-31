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
$sql = "CREATE TABLE Payment (
payment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
payment_option VARCHAR(50) NOT NULL,
card_name VARCHAR(50),
card_number INT(6),
hashed_card_number VARCHAR(50),
salt VARCHAR(80) NOT NULL,
FOREIGN KEY (email) REFERENCES User(email)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Payment created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
