<?php include ('connect.php'); ?>
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
    $query = "SELECT * FROM Orders WHERE order_id=" . $order_id;
    $sql = new sql($conn);
    ?>

    <p><b>Email:</b> <?php echo $sql->find_value($query, "email");?></p>
    <p><b>Order ID:</b> <?php echo $sql->find_value($query, "order_id");?></p>
    <p><b>Order Details:</b></p>

    <?php
    echo "<table style='margin: auto'><tr><th>Item</th><th>Price</th></tr>";
    $query = "SELECT item_name, price FROM Item WHERE item_id IN (SELECT item_id FROM Cart WHERE order_id= " . $order_id . ")";
    $sql->print_table($query, ['item_name', 'price']);
    echo "</table>";
    $conn->close();
    ?>
</body>
</html>
