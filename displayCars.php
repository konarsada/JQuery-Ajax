<?php

$dsn = "mysql:host=" . "localhost" . ";dbname=" . "ajax" . ";charset=utf8";

try {
    $conn = new PDO($dsn, "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM cars";

    $stmt = $conn->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}

?>

<?php foreach($results as $indexes=>$row): ?>
    <tr>
        <td><?= htmlspecialchars($row["id"]); ?></td>
        <td><?= htmlspecialchars($row["cars"]); ?></td>
    </tr>
<?php endforeach; ?>