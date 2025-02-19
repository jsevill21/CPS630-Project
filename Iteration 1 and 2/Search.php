<?php include ('PHP Class.php'); ?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="text-align: center;">
    <h1>Order Search</h1>
    <?php
    $order_id = $_POST['order_id'];
    echo "<table style='margin: auto auto';><tr><th>Email</th><th>Order ID</th></tr>";

    $query = "SELECT * FROM Orders WHERE order_id=" . $order_id;
    $sql = new sql($conn);
    $sql->print_table($query, ['email', 'order_id']);

    echo "</table>";
    $conn->close();
    ?>
</body>
</html>
