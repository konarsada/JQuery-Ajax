<?php

class Database {

    protected $db_host;
    
    protected $db_name;
    
    protected $db_user;
    
    protected $db_pass;

    public function __construct($host, $name, $user, $password) {
        $this->db_host = $host;
        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_pass = $password;
    }

    /**
     * Make database connection
     */
    public function getConn() {
        $dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8";

        try {
            $conn = new PDO($dsn, $this->db_user, $this->db_pass);
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
    public static function searchCar($conn, $searchCar) {
        $sql = "SELECT * FROM cars WHERE title LIKE CONCAT(:search, '%')";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":search", $searchCar, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();

        if($count == 0)
            return false;
        else
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add new car
     */
    public static function newCar($conn, $newCarName) {
        $sql = "INSERT INTO cars(title) VALUES(:carName)";

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

    /**
     * Action - Controller
     * 
     * Get by id
     */
    public static function getById($conn, $id) {
        $sql = "SELECT * FROM cars WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}