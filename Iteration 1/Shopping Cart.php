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
// Fomr data from Main Page.html
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
$mailAddress = $_POST['deliver'];
$login = $_POST['login'];

$valid = false; // Checks if a user successfully signed up or signed in

if ($login == 'signUp') {
    $sql = "INSERT INTO User (email, password, mail_address) VALUES ('" . $email1 . "','" . $pwd1 . "','" . $mailAddress . "');";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Successfully signed up";
        $valid = True;
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }
} elseif ($login == 'signIn') {
    $sql = "SELECT * FROM User WHERE email='" . $email2 . "' and password='" . $pwd2 . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Successfully signed in";
        $valid = True;
    } else {
        echo "Incorrect login credentials";
    }
}

$sql = "SELECT * FROM Item WHERE id in ('" . $_POST['items'] . "')";
$result = $conn->query($sql);

if ($result->num_rows > 0 and $valid == True) {
    echo "<table align='center'><tr><th>ID</th><th>Name</th><th>Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["item_name"]."</td><td>".$row["price"]."</td></tr>";
    }
    echo "</table>";
} else if ($valid == True) {
    echo "No items in shopping cart";
}
$conn->close();
?>
</html>
