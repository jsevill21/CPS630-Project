<?php include ('../Iteration 1 and 2/connect.php'); ?>
<?php include ('../Iteration 1 and 2/PHP Class.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Review Submitted</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="text-align: center;">
<?php
$item_id = $_POST['item_id'];
$rn = $_POST['rn'];
$review = $_POST['review'];
$sql = new sql($conn);
$query = "INSERT INTO Reviews (item_id, rn, review) VALUES (" . $item_id . "," . $rn . ",'" . $review . "')";
$sql->IDU($query, "Review Submitted", "Error submitting review");
$conn->close();
?>
</body>
</html>
