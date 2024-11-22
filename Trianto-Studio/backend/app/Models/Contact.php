<?php

namespace app\Models;

use mysqli;
use app\Config\DatabaseConfig;

class Contact {
    private $conn;

    public function __construct() {
        $config = new DatabaseConfig();
        $this->conn = new mysqli($config->host, $config->user, $config->password, $config->database_name, $config->port);
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM contact");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $data['name'], $data['email'], $data['message']);
        $stmt->execute();
    }
}
