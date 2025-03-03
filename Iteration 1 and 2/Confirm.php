<?php include ('connect.php'); ?>
<?php include ('PHP Class.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="text-align: center;">
    <h1>Order Confrimation</h1>
    <?php
    $sql = new sql($conn);
    $items = explode(',', $_POST['items']);
    $email = $_POST['email'];
    $store = $_POST['store'];
    $delivery_address = $_POST['delivery_address'];
    $payment = $_POST['payment'];

    $find_truck = "SELECT truck_id FROM Truck WHERE store_id=" . $store;
    $truck_id = $sql->find_value($find_truck, 'truck_id');

    $add_to_trip = "INSERT INTO Trip (truck_id, destination) VALUES (" . $truck_id . ",'" . $delivery_address . "')";
    mysqli_multi_query($conn, $add_to_trip);
    $find_trip = "SELECT trip_id FROM Trip ORDER BY trip_id DESC";
    $trip_id = $sql->find_value($find_trip, 'trip_id');

    $add_to_order = "INSERT INTO Orders (email, trip_id, payment_option) VALUES ('" . $email . "'," . $trip_id . ",'" . $payment . "')";
    mysqli_multi_query($conn, $add_to_order);
    $find_order = "SELECT order_id FROM Orders ORDER BY order_id DESC";
    $order_id = $sql->find_value($find_order, 'order_id');

    for ($i = 0; $i < count($items); $i++) {
        $add_to_cart = "INSERT INTO Cart (order_id, item_id) VALUES (" . $order_id . "," . $items[$i] . ")";
        mysqli_multi_query($conn, $add_to_cart);
    }

    $conn->close();
    ?>
    Order <?php echo $order_id . " "?>Confirmed
</body>
</html>
