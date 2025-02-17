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
$email1 = $_POST['email1']; // Used if a user signs up
$email2 = $_POST['email2']; // Used if a user signs in
$pwd1 = $_POST['pwd1']; // Used if a user signs up
$pwd2 = $_POST['pwd2']; // Used if a user signs in
$mailAddress = $_POST['deliver'];
$login = $_POST['login'];

$valid = False; // Checks if a user successfully signed up or signed in

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

echo "<table align='center'><tr><th>ID</th><th>Name</th><th>Price</th></tr>";
if (!empty($_POST['items']) and $valid == True) {
    $query = "SELECT * FROM Item WHERE item_id in (" . $_POST['items'] . ")";
    $sql = new sql();
    $sql->set_conn($conn);
    $sql->print_html_rows($query, ['item_id', 'item_name', 'price']); 
}
echo "</table>";
$conn->close();
?>
</html>
