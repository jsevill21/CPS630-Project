<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "osp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php

$table = $_POST['tables'];
$action = $_POST['actions'];

if ($table == "Item") {
    if ($action == "insert") {
        echo "<form method='post' action='insert.php'>";
        echo "<label for='name'>Item Name:</label><br><input type='text' id='name' name='name'><br>";
        echo "<label for='price'>Item Price:</label><br><input type='text' id='price' name='price'><br>";
        echo "<button type='submit'>Submit</button>";
        echo "</form>";
    } elseif ($action == "delete") {
        echo "<form method='post' action='delete.php'>";
        echo "<label for='name'>Item ID:</label><br><input type='text' id='id' name='id'><br>";
        echo "<button type='submit'>Submit</button>";
        echo "</form>";
    } elseif ($action == "select") {
        echo "<form method='post' action='select.php'>";
        echo "<label for='name'>Item ID:</label><br><input type='text' id='id' name='id'><br>";
        echo "<button type='submit'>Submit</button>";
        echo "</form>";
    } elseif ($action == "update") {
        echo "<form method='post' action='update.php'>";
        echo "<label for='name'>Item ID:</label><br><input type='text' id='id' name='id'><br>";
        echo "<label for='name'>Item Name:</label><br><input type='text' id='name' name='name'><br>";
        echo "<label for='price'>Item Price:</label><br><input type='text' id='price' name='price'><br>";
        echo "<button type='submit'>Submit</button>";
        echo "</form>";
    }
}

?>