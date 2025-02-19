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
    // For inserting, deleting, or updating rows
    public $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // When you want to find a specific value
    public function find_value($query, $column) {
        $result = $this->conn->query($query);
        $value = 0;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $value = $row[$column];
        }
        return $value;
    }

    // For inserting, deleting, or updating tables. Also provides a success or error message when the transaction is done
    public function IDU($query, $sucess_msg, $error_msg) {
        if (mysqli_multi_query($this->conn, $query)) {
            echo $sucess_msg;
        } else {
            echo $error_msg;
        }
    }

    // For selecting rows, this function uses print_r to print the rows
    public function print_at_once($query) {
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                print_r($row);
                echo "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    // For selecting rows, this function creates an HTML table
    public function print_table($query, $columns) {
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                for ($i = 0; $i < count($columns); $i++) {
                    echo "<td>".$row[$columns[$i]]. "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
    }
}
?>
