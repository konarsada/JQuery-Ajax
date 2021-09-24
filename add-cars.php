<?php

require "includes/init.php";

if(isset($_POST["car-name"])) {
    $carName = $_POST["car-name"];

    $addCar = new Database();

    $conn = Database::getConn();

    $isCarAdded = $addCar->newCar($conn, $carName);

    if($isCarAdded) {
        echo "New car- " . $carName . " added to database";
    }
}