<?php

class Database {

    /**
     * Make database connection
     */
    public static function getConn() {
        $dsn = "mysql:host=" . "localhost" . ";dbname=" . "ajax" . ";charset=utf8";

        try {
            $conn = new PDO($dsn, "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * Show all cars of a particular brand
     */
    public function searchCar($conn, $searchCar) {
        $sql = "SELECT * FROM cars WHERE cars LIKE CONCAT(:search, '%')";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":search", $searchCar, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add new car
     */
    public function newCar($conn, $newCarName) {
        $sql = "INSERT INTO cars(cars) VALUES(:carName)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":carName", $newCarName, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }

    /**
     * Show all cars
     */
    public static function getAll($conn) {
        $sql = "SELECT * FROM cars";

        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}