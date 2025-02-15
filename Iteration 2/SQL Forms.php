<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Forms</title>
</head>

<body>
    <h1>Enter Parameters</h1>
    <form method="POST">
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
            echo "<label for='fields'>Fields (separate by commas): </label>";
            echo "<input type='text' id='fields' name='fields'><br>";
            echo "<label for='fields'>Values (separate by commas): </label>";
            echo "<input type='text' id='fields' name='fields'><br>";
        } elseif ($action == 'delete') {
            echo "<input type='hidden' id='action' name='action' value='delete'>";
            echo "<label for='condition'>Condition: </label>";
            echo "<input type='text' id='condition' name='condition'><br>";
        } elseif ($action == 'update') {
            echo "<input type='hidden' id='action' name='action' value='update'>";
            echo "<label for='newValues'>New Values (separate by commas, format is columnName=newValue): </label>";
            echo "<input type='text' id='newValues' name='fields'><br>";
            echo "<label for='condition'>Condition: </label>";
            echo "<input type='text' id='condition' name='condition'><br>";
        } elseif ($action == 'select') {
            echo "<input type='hidden' id='action' name='action' value='select'>";
            echo "<label for='fields'>Fields (separate by commas): </label>";
            echo "<input type='text' id='fields' name='fields'><br>";
            echo "<label for='condition'>Condition: </label>";
            echo "<input type='text' id='condition' name='condition'><br>";
        }
        ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>