<?php

if(isset($_POST["car-name"])) {
    $carName = $_POST["car-name"];
    $dsn = "mysql:host=" . "localhost" . ";dbname=" . "ajax" . ";charset=utf8";
    
    try {
        $conn = new PDO($dsn, "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO cars(cars) VALUES(:carName)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":carName", $carName, PDO::PARAM_STR);
        $stmt->execute();

        echo "New car- " . $carName . " added to database";
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}