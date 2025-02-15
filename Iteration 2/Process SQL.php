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
$action = $_POST['action'];
$table = $_POST['table'];
$sql = "";

if ($action == 'select') {
    $sql = "SELECT * FROM " . $table . " WHERE id=" . $_POST['ID'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            print_r($row);
            echo "<br>";
        }
    } else {
        echo "0 results";
    }
} elseif ($action == 'insert') {
    $values = explode(",", $_POST['values']);
    $sql = "INSERT INTO " . $table . " (" . $_POST['column']  . ") VALUES (";

    for ($i = 0; $i < count($values) - 1; $i++) {
        $sql .= "'" . $values[$i] . "',";
    }
    $sql .= "'" . $values[count($values) - 1] . "')";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "Record created successfully";
    } else {
        echo "Error" .$sql. "<br>" .$conn->error;
    }
} elseif ($action == 'delete') {
    $sql = "DELETE FROM " . $table . " WHERE id=" . $_POST['ID'];
    if (mysqli_multi_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " .$sql. "<br>" .$conn->error;
    }
} elseif ($action == 'update') {
    $sql = "UPDATE " . $table . " SET " . $_POST['column'] . "=" . $_POST['newValue'] . " WHERE id=" . $_POST['ID'];
    if (mysqli_multi_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record(s): " .$sql. "<br>" .$conn->error;
    }
}
$conn->close();
?>