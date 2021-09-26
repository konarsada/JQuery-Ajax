<?php

require "includes/init.php";
$db = require "includes/db.php";

// make the database connection and query result
if(isset($_POST["search"])) {
    $search = $_POST["search"];

    $conn = $db->getConn();

    $results = Database::searchCar($conn, $search);
}

?>

<?php if(!$results): ?>
    <h3>Car not available</h3>
<?php else: ?>
    <ul>
        <?php foreach($results as $indexes=>$row): ?>
            <li><?= htmlspecialchars($row["title"]); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>