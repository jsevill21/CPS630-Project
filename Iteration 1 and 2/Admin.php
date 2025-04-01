<?php include ('connect.php'); ?>
<?php include ('PHP Class.php'); ?>
<?php
function generateRandomSalt() {
    return bin2hex(random_bytes(6));
}
?>

<!DOCTYPE html>
<html lang="eng">
    
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    $action = $_POST['action'];
    $table = $_POST['table'];
    $sql = new sql($conn);
    
    if ($action == 'select') {
        if (empty($_POST['condition'])) {
            $sql->print_at_once("SELECT " . $_POST['columns'] . " FROM " . $table);
        } else {
            $sql->print_at_once("SELECT " . $_POST['columns'] . " FROM " . $table . " " . $_POST['condition']);
        }
    } elseif ($action == 'insert') {
        if ($table == 'User') {
            $columns = explode(", ", $_POST['columns']);
            $values = explode(", ", $_POST['values']);        
            
            $emailIndex = array_search('email', $columns);
            $passwordIndex = array_search('password', $columns);
        
            if ($emailIndex !== false && $passwordIndex !== false) {
                $email = trim($values[$emailIndex], "'");
                $password = trim($values[$passwordIndex], "'");        
                
                $salt = generateRandomSalt();
                $hashedPassword = md5($password . $salt);        
                
                $values[$passwordIndex] = "'" . $hashedPassword . "'";        
                
                if (!in_array('salt', $columns)) {
                    $columns[] = 'salt';
                    $values[] = "'" . $salt . "'";
                }        
                
                $query = "INSERT INTO User (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";
                $sql->IDU($query, "Record created successfully", "Error creating user");
            } else {
                echo "Error: Missing email or password field.";
            }
        } elseif ($table == 'Payment') { 
            $columns = explode(", ", $_POST['columns']);
            $values = explode(", ", $_POST['values']);        
            
            $cardNumberIndex = array_search('card_number', $columns);
        
            if ($cardNumberIndex !== false) {
                $cardNumber = trim($values[$cardNumberIndex], "'");        
                
                $salt = generateRandomSalt();
                $hashedCardNumber = md5($cardNumber . $salt);        
                
                $columns[] = 'hashed_card_number';
                $values[] = "'" . $hashedCardNumber . "'";
        
                if (!in_array('salt', $columns)) {
                    $columns[] = 'salt';
                    $values[] = "'" . $salt . "'";
                }
        
                $query = "INSERT INTO Payment (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";                
                $sql->IDU($query, "Record created successfully", "Error creating record");
            } else {
                echo "Error: Missing card_number field.";
            }
        } else {
            $query = "INSERT INTO " . $table . " (" . $_POST['columns'] . ") VALUES (" . $_POST['values'] . ")";
            $sql->IDU($query, "Record created successfully", "Error creating record");
        }
    } elseif ($action == 'delete') {
        $query = "DELETE FROM " . $table . " " . $_POST['condition'];
        $sql->IDU($query, "Record(s) deleted successfully", "Error deleting record(s)");
    } elseif ($action == 'update') {
        $query = "UPDATE " . $table . " SET " . $_POST['column'] . "=" . $_POST['newValue'] . " " . $_POST['condition'];
        $sql->IDU($query, "Record updated successfully", "Error updating record");
    }
    $conn->close();
    ?>
</body>
</html>
