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

<?php
// Form data from Main Page.html
$email1 = $_POST['email']; 
$pwd2 = $_POST['pwd'];
$mail_address = $_POST['mail_address'];
$branch = $_POST['branch'];
$items = $_POST['items'];
$login = $_POST['login'];

$valid = False; // Checks if a user successfully signed up or signed in

if ($login == 'signUp') {
    $query = "INSERT INTO User (email, password, mail_address) VALUES ('" . $email . "','" . $pwd . "','" . $mail_address . "');";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Successfully signed up";
        $valid = True;
    } else {
        echo "Error" . $query . "<br>" . $conn->error;
    }
} elseif ($login == 'signIn') {
    $query = "SELECT * FROM User WHERE email='" . $email . "' and password='" . $pwd . "'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "Successfully signed in";
        $valid = True;
    } else {
        echo "Incorrect login credentials";
    }
}

echo "<table align='center'><tr><th>ID</th><th>Name</th><th>Price</th></tr>";
if (!empty($_POST['items']) and $valid == True) {
    $query = "SELECT * FROM Item WHERE item_id in (" . $items . ")";
    $sql = new sql($conn);
    $sql->print_html_rows($query, ['item_id', 'item_name', 'price']); 
}
echo "</table>";
$conn->close();
?>
</html>
