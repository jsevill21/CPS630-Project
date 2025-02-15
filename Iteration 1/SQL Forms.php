<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Forms</title>
</head>

<body>
    <h1>Enter Parameters</h1>
    <form method="POST" action="Process SQL.php">
        Select Table: 
        <input list="tables" id="table" name="table">
        <datalist id="tables">
            <option value="Item">
            <option value="User">
        </datalist><br>

        <?php
        $action = $_POST['actions'];
        if ($action == 'insert') {
            echo "<input type='hidden' id='action' name='action' value='insert'>";
            echo "<label for='column'>Column: </label>";
            echo "<input type='text' id='column' name='column'><br>";
            echo "<label for='values'>Values (separate by commas): </label>";
            echo "<input type='text' id='values' name='values'><br>";
        } elseif ($action == 'delete') {
            echo "<input type='hidden' id='action' name='action' value='delete'>";
            echo "<label for='ID'>ID: </label>";
            echo "<input type='text' id='ID' name='ID'><br>";
        } elseif ($action == 'update') {
            echo "<input type='hidden' id='action' name='action' value='update'>";
            echo "<label for='column'>Column: </label>";
            echo "<input type='text' id='column' name='column'><br>";
            echo "<label for='newValue'>New Value: </label>";
            echo "<input type='text' id='newValue' name='newValue'><br>";
            echo "<label for='ID'>ID: </label>";
            echo "<input type='text' id='ID' name='ID'><br>";
        } elseif ($action == 'select') {
            echo "<input type='hidden' id='action' name='action' value='select'>";
            echo "<label for='ID'>ID: </label>";
            echo "<input type='text' id='ID' name='ID'><br>";
        }
        ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
