<?php include ('PHP Class.php'); ?>

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
    echo "<table align='center'><tr><th>User ID</th><th>Order ID</th></tr>";

    $query = "SELECT * FROM Orders WHERE order_id=" . $order_id;
    $sql = new sql($conn);
    $sql->print_html_rows($query, ['user_id', 'order_id']);

    echo "</table>";
    $conn->close();
    ?>
</body>
</html>
