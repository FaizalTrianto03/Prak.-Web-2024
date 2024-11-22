<?php

namespace app\Models;

use mysqli;
use app\Config\DatabaseConfig;

class Team {
    private $conn;

    public function __construct() {
        $config = new DatabaseConfig();
        $this->conn = new mysqli($config->host, $config->user, $config->password, $config->database_name, $config->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM team");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO team (name, position, skills, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['name'], $data['position'], $data['skills'], $data['image_url']);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM team WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
