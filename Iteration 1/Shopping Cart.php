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
<html>
<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; text-align: center;}
    </style>
</head>

<?php
$sql = "SELECT * FROM Item WHERE id in (" . $_POST['cartItems'] . ")";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table align='center'><tr><th>ID</th><th>Name</th><th>Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["item_name"]."</td><td>".$row["price"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No items in shopping cart";
}

$conn->close();
?>
</html>
