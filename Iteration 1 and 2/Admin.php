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
        if ($table == 'User') { // Only modify if inserting into User table
            $columns = explode(", ", $_POST['columns']);
            $values = explode(", ", $_POST['values']);
        
            // Ensure email and password are present
            $emailIndex = array_search('email', $columns);
            $passwordIndex = array_search('password', $columns);
        
            if ($emailIndex !== false && $passwordIndex !== false) {
                $email = trim($values[$emailIndex], "'");
                $password = trim($values[$passwordIndex], "'");
        
                // Generate salt and hash password
                $salt = generateRandomSalt();
                $hashedPassword = md5($password . $salt);
        
                // Replace plaintext password with hashed one
                $values[$passwordIndex] = "'" . $hashedPassword . "'";
        
                // **Only add salt if it's not already in columns**
                if (!in_array('salt', $columns)) {
                    $columns[] = 'salt';
                    $values[] = "'" . $salt . "'";
                }
        
                // Final SQL query
                $query = "INSERT INTO User (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";
                $sql->IDU($query, "Record created successfully", "Error creating user");
            } else {
                echo "Error: Missing email or password field.";
            }
        } else {
            // Default insert for other tables
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
