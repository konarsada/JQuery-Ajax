<?php

require "includes/init.php";

$conn = Database::getConn();

$results = Database::getAll($conn);

?>

<?php foreach($results as $indexes=>$row): ?>
    <tr>
        <td><?= htmlspecialchars($row["id"]); ?></td>
        <td><?= htmlspecialchars($row["cars"]); ?></td>
    </tr>
<?php endforeach; ?>