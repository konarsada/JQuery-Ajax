<?php

require "includes/init.php";
$db = require "includes/db.php";

if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $conn = $db->getConn();
    $car = Database::getById($conn, $id);
}

?>

<?php if(isset($car) && $car): ?>
    <input type="text" class="form-control">
    <button class="btn btn-success">Update</button>
    <button class="btn btn-danger">Delete</button
<?php endif; ?>