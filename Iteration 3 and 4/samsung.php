<?php include ('connect.php'); ?>
<?php include ('PHP Class.php'); ?>

<?php
$sql = new sql($conn);
$query = "SELECT * FROM Reviews WHERE item_id=4";
echo "<table style='margin: auto; text-align: center;'><tr><th>Review</th><th>Ranking Number</th></tr>";
$sql->print_table($query, ['review', 'rn']);
echo "</table>";
?>