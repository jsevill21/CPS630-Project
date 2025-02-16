<?php include ('PHP Class.php'); ?>

<?php
$action = $_POST['action'];
$table = $_POST['table'];
$sql = new sql();

if ($action == 'select') {
    if (empty($_POST['condition'])) {
        $sql->print_at_once("SELECT " . $_POST['columns'] . " FROM " . $table);
    } else {
        $sql->print_at_once("SELECT " . $_POST['columns'] . " FROM " . $table . " WHERE " . $_POST['condition']);
    }
} elseif ($action == 'insert') {
    $query = "INSERT INTO " . $table . " (" . $_POST['columns']  . ") VALUES (" . $_POST['values'] . ")";
    $sql->IDU($query, "Record created sucessfully", "Error creating record");
} elseif ($action == 'delete') {
    $query = "DELETE FROM " . $table . " WHERE " . $_POST['condition'];
    $sql->IDU($query, "Record(s) deleted successfully", "Error deleting record(s)");
} elseif ($action == 'update') {
    $query = "UPDATE " . $table . " SET " . $_POST['column'] . "=" . $_POST['newValue'] . " WHERE " . $_POST['condition'];
    $sql->IDU($query, "Record updated successfully", "Error updating record");
}
$conn->close();
?>
