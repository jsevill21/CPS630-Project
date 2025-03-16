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
$sql = "CREATE TABLE Reviews (
review_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
item_id INT(6) UNSIGNED NOT NULL,
rn INT(6) NOT NULL,
review VARCHAR(80),
FOREIGN KEY (item_id) REFERENCES Item(item_id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table Reviews created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?> 
