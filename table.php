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
$sql = "CREATE TABLE Item (
id INT(6) PRIMARY KEY,
item_name VARCHAR(30) NOT NULL,
price DECIMAL NOT NULL,
department_code INT(6)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Item created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 