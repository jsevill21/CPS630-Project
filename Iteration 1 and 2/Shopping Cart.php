<?php include ('PHP Class.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; text-align: center;}
    </style>
</head>

<body>
    <?php
    $delivery_address = $_POST['delivery_address'];
    $login = $_POST['login'];
    $store = $_POST['store'];
    $items = $_POST['items'];
    $valid = False;
    $sql = new sql($conn);

    if ($login == 'signUp') {
        $email = $_POST['signUp_email'];
        $pwd = $_POST['signUp_pwd'];
        if ($conn->query("SELECT * FROM User WHERE email='" . $email . "'")->num_rows > 0) {
            echo "You have already signed up";
        } else {
            $query = "INSERT INTO User (email, password, delivery_address) VALUES ('" . $email . "','" . $pwd . "','" . $delivery_address . "');";
            if (mysqli_multi_query($conn, $query)) {
                echo "Successfully signed up";
                $valid = True;
            } else {
                echo "Error" . $query . "<br>" . $conn->error;
            }
        }
    } elseif ($login == 'signIn') {
        $email = $_POST['signIn_email'];
        $pwd = $_POST['signIn_pwd'];
        $query = "SELECT * FROM User WHERE email='" . $email . "' and password='" . $pwd . "'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "Successfully signed in";
            $valid = True;
        } else {
            echo "Incorrect login credentials";
        }
        $delivery_address = $sql->find_value("SELECT delivery_address FROM User WHERE email='" . $email . "'", 'delivery_address');
    }

    echo "<table align='center'><tr><th>ID</th><th>Name</th><th>Price</th></tr>";
    if (!empty($_POST['items']) and $valid == True) {
        $query = "SELECT * FROM Item WHERE item_id in (" . $items . ")";
        $sql->print_html_rows($query, ['item_id', 'item_name', 'price']); 
        echo "</table>";

        echo "Store: " . $sql->find_value("SELECT store_name FROM Store WHERE store_id=" . $store, 'store_name');
        echo "<form action='Confirm.php' method='POST'>";
        echo "<input type='hidden' id='items' name='items' value=" . $items. ">";
        echo "<input type='hidden' id='email' name='email' value=" . $email . ">";
        echo "<input type='hidden' id='delivery_address' name='delivery_address' value='" . $delivery_address . "'>";
        echo "<input type='hidden' id='store' name='store' value=" . $store . ">";
        echo "<button type='submit'>Confirm Order</button>";
        echo "</form>";
    }
    $conn->close();
    ?>
</body>
</html>