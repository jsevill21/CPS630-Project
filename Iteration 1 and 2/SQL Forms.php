<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Forms</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Enter Parameters</h1>
    <p>When inserting values or specifying WHERE conditionals, enclose string values with single quotes</p>
    <form method="POST" action="Admin.php">
        Select Table: 
        <input list="tables" id="table" name="table">
        <datalist id="tables">
            <option value="Item">
            <option value="User">
            <option value="Orders">
            <option value="Store">
            <option value="Trip">
            <option value="Truck">
        </datalist><br>

        <?php
        $action = $_POST['actions'];
        if ($action == 'insert') {
            echo "<input type='hidden' id='action' name='action' value='insert'>";
            echo "<label for='columns'>Columns (separate by commas): </label>";
            echo "<input type='text' id='columns' name='columns'><br>";
            echo "<label for='values'>Values (separate by commas): </label>";
            echo "<input type='text' id='values' name='values'><br>";
        } elseif ($action == 'delete') {
            echo "<input type='hidden' id='action' name='action' value='delete'>";
            echo "<label for='condition'>Condition: </label>";
            echo "<input type='text' id='condition' name='condition'><br>";
        } elseif ($action == 'update') {
            echo "<input type='hidden' id='action' name='action' value='update'>";
            echo "<label for='column'>Column: </label>";
            echo "<input type='text' id='column' name='column'><br>";
            echo "<label for='newValue'>New Value: </label>";
            echo "<input type='text' id='newValue' name='newValue'><br>";
            echo "<label for='condition'>Condition: </label>";
            echo "<input type='text' id='condition' name='condition'><br>";
        } elseif ($action == 'select') {
            echo "<input type='hidden' id='action' name='action' value='select'>";
            echo "<label for='columns'>Columns (separate by commas): </label>";
            echo "<input type='text' id='columns' name='columns'><br>";
            echo "<label for='condition'>Condition: </label>";
            echo "<input type='text' id='condition' name='condition'><br>";
        }
        ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
