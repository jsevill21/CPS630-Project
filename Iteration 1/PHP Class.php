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
class sql {
    function IDU($query, $sucess_msg, $error_msg, $conn) {
        if (mysqli_multi_query($conn, $query)) {
            echo $sucess_msg;
        } else {
            echo $error_msg;
        }
    }

    function print_at_once($query, $conn) {
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                print_r($row);
                echo "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    function print_table($query, $column_format, $columns, $conn) {
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo $column_format;
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                for ($i = 0; $i < count($columns); $i++) {
                    echo "<td>".$row[$columns[$i]]. "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
}
?>