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
    <h1>Search Orders<h1>
    User ID:
    <input list="user_ids" name="user_id" id="user_id">
    <datalist id="user_ids">
        <?php
        $sql = "SELECT DISTINCT user_id FROM Order";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value=". $row["user_id"] . "></option>";
            }
        }
        ?>
    </datalist>
    Order ID:
    <input list="order_ids" name="order_id" id="order_id">
    <datalist id="order_ids">
        <?php
        $sql = "SELECT order_id FROM Order";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value=". $row["order_id"] . "></option>";
            }
        }
        $conn->close();
        ?>
    </datalist>
</body>
</html>