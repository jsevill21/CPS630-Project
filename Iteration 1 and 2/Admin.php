<?php include ('connect.php'); ?>
<?php include ('PHP Class.php'); ?>

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
        $query = "INSERT INTO " . $table . " (" . $_POST['columns']  . ") VALUES (" . $_POST['values'] . ")";
        $sql->IDU($query, "Record created sucessfully", "Error creating record");
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
