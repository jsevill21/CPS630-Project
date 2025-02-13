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

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <style>
        body {text-align: center;}
    </style>
</head>

<body>
    <h1>Order Search</h1>
    <?php
    $order_id = $_POST['order_id'];
    $sql = "SELECT * FROM Order WHERE order_id=" . $order_id;
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table align='center'><tr><th>User ID</th><th>Order ID</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["user_id"]. "</td><td>" . $row["order_id"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No orders found";
    }
    $conn->close();
    ?>
</body>
</html>