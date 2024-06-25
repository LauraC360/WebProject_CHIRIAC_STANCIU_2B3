<?php
require 'constants.php';

class Database {
    private $server = "database-own-server.cvwyk6sq0sk6.eu-north-1.rds.amazonaws.com";
    private $username = "admin";
    private $password = "numaipot22";

    private $db = "webproj_db";

    public $conn;

    public function __construct() {
        
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);

            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed!";
            //echo "Connection failed: " . $e->getMessage();
        }
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}

?>
