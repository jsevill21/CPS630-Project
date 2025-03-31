<?php include ('connect.php'); ?>
<?php include ('PHP Class.php'); ?>
<?php
function generateRandomSalt() {
    return bin2hex(random_bytes(6));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="text-align: center;">
    <h1>Order Summary</h1>
    <?php
    $delivery_address;
    $login = $_POST['login'];
    $store = $_POST['store'];
    $items = $_POST['items'];
    $express_shipping = $_POST['express_shipping'];
    $payment_option;
    $valid = False; // Checks if login credentials are valid
    $sql = new sql($conn);

    if ($login == 'signUp') {
        $email = $_POST['signUp_email'];
        $pwd = $_POST['signUp_pwd'];
        $salt = generateRandomSalt();
        $hashedpwd = md5($pwd . $salt);
        $delivery_address = $_POST['delivery_address'];
        $payment_option = $_POST['payment_option'];
        $card_number = $_POST['card_number'];
        $hashed_card_number = md5($card_number . $salt); 
        $card_name = $_POST['card_name'];
        
        if ($conn->query("SELECT * FROM User WHERE email='" . $email . "'")->num_rows > 0) {
            echo "You have already signed up";
        } else {
            $query1 = "INSERT INTO User (email, salt, password, delivery_address) VALUES ('" . $email . "','" . $salt . "','" . $hashedpwd . "','" . $delivery_address . "');";
            $query2 = "INSERT INTO Payment (email, payment_option, card_name, card_number, hashed_card_number, salt) VALUES ('" . $email . "','" . $payment_option . "','" . $card_name . "','" . $card_number . "','" . $hashed_card_number . "','" . $salt . "')";
            if (mysqli_multi_query($conn, $query1) and mysqli_multi_query($conn, $query2)) {
                echo "Successfully signed up";
                $valid = True;
            } else {
                echo "Error" . $query . "<br>" . $conn->error;
            }
        }
    } elseif ($login == 'signIn') {
        $email = $_POST['signIn_email'];
        $pwd = $_POST['signIn_pwd'];
        // First, fetch salt and password from the database for the given email
        $stmt = $conn->prepare("SELECT password, salt FROM User WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($storedPassword, $salt);
        $stmt->fetch();
        $stmt->close();

        if ($storedPassword && $salt) { 
            // Hash the input password with the retrieved salt
            $hashedInput = md5($pwd . $salt);

            if ($hashedInput === $storedPassword) {
                echo "Successfully signed in";
                $valid = True;
            } else {
                echo "Incorrect login credentials";
            }
        } else {
            echo "Incorrect login credentials";
        }
        $delivery_address = $sql->find_value("SELECT delivery_address FROM User WHERE email='" . $email . "'", 'delivery_address');
        $payment_option = $sql->find_value("SELECT payment_option FROM Payment WHERE email='" . $email . "'", 'payment_option');
    } 

    if (!empty($_POST['items']) and $valid == True) {
        echo "<table style='margin: auto'><tr><th>Name</th><th>Price</th></tr>";
        $sql->print_table("SELECT * FROM Item WHERE item_id in (" . $items . ")", ['item_name', 'price']); 
        echo "</table>";
        
        $total_price = $sql->find_value("SELECT SUM(price) AS total_price FROM Item WHERE item_id in (" . $items . ")", "total_price");
        if ($express_shipping == 0) {
            echo "Total: " . $total_price . "<br>";
        } else {
            echo "Total (+ express shipping): " . $total_price + 20 . "<br>";
        }
        echo "Store: " . $sql->find_value("SELECT store_name FROM Store WHERE store_id=" . $store, 'store_name') . "<br>";
        echo "Address: " . $delivery_address . "<br>";
        echo "Payment Option: " . $payment_option;
        $card_name = $sql->find_value("SELECT card_name FROM Payment WHERE email='" . $email . "'", 'card_name');
        $card_number = $sql->find_value("SELECT card_number FROM Payment WHERE email='" . $email . "'", 'card_number');

        // Mask all but last 4 digits of card number for privacy
        $masked_card_number = str_repeat("*", strlen($card_number) - 4) . substr($card_number, -4);

        echo "<br>Card Name: " . htmlspecialchars($card_name);
        echo "<br>Card Number: " . htmlspecialchars($masked_card_number);

        
        echo "<form action='Confirm.php' method='POST'>";
        echo "<input type='hidden' id='items' name='items' value=" . $items . ">";
        echo "<input type='hidden' id='email' name='email' value=" . $email . ">";
        echo "<input type='hidden' id='delivery_address' name='delivery_address' value='" . $delivery_address . "'>";
        echo "<input type='hidden' id='store' name='store' value=" . $store . ">";
        echo "<button type='submit'>Confirm Order</button>";
        echo "</form>";
        
        echo "<div id='map' style='width:50vw; height:50vh; left:25vw'></div>";
    }
    ?>
    <script>
        function initMap() {
            origin = {
                lat: <?php echo $sql->find_value("SELECT latitude FROM Store WHERE store_id=" . $store, 'latitude');?>, 
                lng: <?php echo $sql->find_value("SELECT longitude FROM Store WHERE store_id=" . $store, 'longitude'); $conn->close();?>
            };
            map = new google.maps.Map(document.getElementById("map"), {zoom: 14, center: origin});

            navigator.geolocation.getCurrentPosition(showDestination);
            function showDestination(position){
                destination = {lat: position.coords.latitude, lng: position.coords.longitude};

                ds = new google.maps.DirectionsService();
                dr = new google.maps.DirectionsRenderer();

                ds.route({origin: origin, destination: destination, travelMode: google.maps.TravelMode.DRIVING}, (path) => {dr.setDirections(path);});
                dr.setMap(map);
            }
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUkLHIQlaZOxsAaWYeUNivaFyXEcbJ5uY&callback=initMap"></script>
</body>
</html>
