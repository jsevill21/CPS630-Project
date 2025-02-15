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
    $query = "SELECT * FROM Order WHERE order_id=" . $order_id;

    $sql = new sql();
    $sql->print_table($query, "<table align='center'><tr><th>User ID</th><th>Order ID</th></tr>", array('user_id', 'id'), $conn);

    $conn->close();
    ?>
</body>
</html>
