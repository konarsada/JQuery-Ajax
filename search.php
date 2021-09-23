<?php



// make the database connection and query result
if(isset($_POST["search"])) {
    $search = $_POST["search"];

    $dsn = "mysql:host=" . "localhost" . ";dbname=" . "ajax" . ";charset=utf8";
    
    try {
        $conn = new PDO($dsn, "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM cars WHERE cars LIKE CONCAT(:search, '%')";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":search", $search, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

?>


<ul>
    <?php foreach($results as $indexes=>$row): ?>
        <li><?= htmlspecialchars($row["cars"]); ?></li>
    <?php endforeach; ?>
</ul>