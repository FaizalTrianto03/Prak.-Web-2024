<?php

namespace app\Models;

require_once __DIR__ . '/../Config/DatabaseConfig.php';

use mysqli;
use app\Config\DatabaseConfig;

class Testimonial {
    private $conn;

    public function __construct() {
        $config = new DatabaseConfig();
        $this->conn = new mysqli($config->host, $config->user, $config->password, $config->database_name, $config->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM testimonials");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO testimonials (client_name, testimonial, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['client_name'], $data['testimonial'], $data['date']);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM testimonials WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
