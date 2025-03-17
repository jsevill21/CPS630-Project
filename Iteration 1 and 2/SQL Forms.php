<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Forms</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Enter Parameters</h1>
    <p>When inserting values or specifying conditions (e.g., WHERE email='joe@gmail.com'), enclose string values with single quotes.</p><br>
    <form method="POST" action="Admin.php">
        <label for="table">Select Table: </label>
        <select id="table" name="table">
            <option value="Item">Item</option>
            <option value="User">User</option>
            <option value="Payment">Payment</option>
            <option value="Orders">Orders</option>
            <option value="Reviews">Reviews</option>
            <option value="Store">Store</option>
            <option value="Trip">Trip</option>
            <option value="Truck">Truck</option>
        </select><br>

        <?php
        $action = $_POST['actions'];
        if ($action == 'insert') {
            echo "<input type='hidden' id='action' name='action' value='insert'>";
            echo "<label for='columns'>Columns (separate by commas): </label><br>";
            echo "<input type='text' id='columns' name='columns'><br>";
            echo "<label for='values'>Values (separate by commas): </label><br>";
            echo "<input type='text' id='values' name='values'><br>";
        } elseif ($action == 'delete') {
            echo "<input type='hidden' id='action' name='action' value='delete'>";
            echo "<label for='condition'>Condition: </label><br>";
            echo "<input type='text' id='condition' name='condition'><br>";
        } elseif ($action == 'update') {
            echo "<input type='hidden' id='action' name='action' value='update'>";
            echo "<label for='column'>Column: </label><br>";
            echo "<input type='text' id='column' name='column'><br>";
            echo "<label for='newValue'>New Value: </label><br>";
            echo "<input type='text' id='newValue' name='newValue'><br>";
            echo "<label for='condition'>Condition: </label><br>";
            echo "<input type='text' id='condition' name='condition'><br>";
        } elseif ($action == 'select') {
            echo "<input type='hidden' id='action' name='action' value='select'>";
            echo "<label for='columns'>Columns (separate by commas): </label><br>";
            echo "<input type='text' id='columns' name='columns'><br>";
            echo "<label for='condition'>Condition: </label><br>";
            echo "<input type='text' id='condition' name='condition'><br>";
        }
        ?>
        <button type="submit">Submit</button>
    </form>
    <h3>Table Attributes</h3>
    <table>
        <tr><th>Table</th><th>Attributes</th></tr>
        <tr><td>Item</td><td>item_id, item_name, price</td></tr>
        <tr><td>User</td><td>email, password, delivery_address</td></tr>
        <tr><td>Orders</td><td>order_id, email, trip_id</td></tr>
        <tr><td>Store</td><td>store_id, store_name, latitude, longitude</td></tr>
        <tr><td>Trip</td><td>trip_id, truck_id, destination</td></tr>
        <tr><td>Truck</td><td>truck_id, store_id</td></tr>
    </table>
    <a href="Main Page.html"><button>User Mode</button></a>
</body>
</html>
