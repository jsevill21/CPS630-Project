<?php include ('../Iteration 1 and 2/connect.php'); ?>
<?php include ('../Iteration 1 and 2/PHP Class.php'); ?>

<h3>iPhone</h3>
<?php
$sql = new sql($conn);
$query = "SELECT * FROM Reviews WHERE item_id=5";
echo "<table style='margin: auto; text-align: center;'><tr><th>Review</th><th>Ranking Number</th></tr>";
$sql->print_table($query, ['review', 'rn']);
echo "</table>";
?>
