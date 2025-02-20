<?php include ('connect.php'); ?>
<?php include ('PHP Class.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="text-align: center;">
    <?php
    $delivery_address = $_POST['delivery_address'];
    $login = $_POST['login'];
    $store = $_POST['store'];
    $items = $_POST['items'];
    $valid = False; // Checks if login credentials are valid
    $sql = new sql($conn);

    if ($login == 'signUp') {
        $email = $_POST['signUp_email'];
        $pwd = $_POST['signUp_pwd'];
        if (empty($email) or empty($pwd) or empty($delivery_address)) {
            echo "Please enter valid email, password, and address";
        } elseif ($conn->query("SELECT * FROM User WHERE email='" . $email . "'")->num_rows > 0) {
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

    if (!empty($_POST['items']) and $valid == True) {
        echo "<table style='margin: auto'><tr><th>ID</th><th>Name</th><th>Price</th></tr>";
        $query = "SELECT * FROM Item WHERE item_id in (" . $items . ")";
        $sql->print_table($query, ['item_name', 'price']); 
        echo "</table>";

        echo "Store: " . $sql->find_value("SELECT store_name FROM Store WHERE store_id=" . $store, 'store_name');
        echo "<form action='Confirm.php' method='POST'>";
        echo "<input type='hidden' id='items' name='items' value=" . $items. ">";
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
