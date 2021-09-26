<?php

require "includes/init.php";
$db = require "includes/db.php";

if(isset($_POST["car-name"])) {
    $carName = $_POST["car-name"];

    $conn = $db->getConn();

    $isCarAdded = Database::newCar($conn, $carName);
}

?>

<?php if($isCarAdded): ?>
    <h3 class="success">New Car: <?= $carName; ?> has been added.</h3>
<?php endif; ?>