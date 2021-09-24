<?php

require "includes/init.php";

// make the database connection and query result
if(isset($_POST["search"])) {
    $search = $_POST["search"];

    $searchCar = new Database();

    $conn = Database::getConn();

    $results = $searchCar->searchCar($conn, $search);
}

?>


<ul>
    <?php foreach($results as $indexes=>$row): ?>
        <li><?= htmlspecialchars($row["cars"]); ?></li>
    <?php endforeach; ?>
</ul>