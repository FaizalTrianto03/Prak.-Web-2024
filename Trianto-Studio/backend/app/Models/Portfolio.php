<?php

namespace app\Models;

require_once __DIR__ . '/../Config/DatabaseConfig.php';

use mysqli;
use app\Config\DatabaseConfig;

class Portfolio {
    private $conn;

    public function __construct() {
        $config = new DatabaseConfig();
        $this->conn = new mysqli($config->host, $config->user, $config->password, $config->database_name, $config->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAll() {
        $result = $this->conn->query("SELECT id, title, description, CONCAT('http://localhost:8181/portfolio/', image_url) AS image_url, category, date FROM portfolio");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT id, title, description, CONCAT('http://localhost:8181/portfolio/', image_url) AS image_url, category, date FROM portfolio WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO portfolio (title, description, image_url, category, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['title'], $data['description'], $data['image_url'], $data['category'], $data['date']);
        $stmt->execute();
    }
    

    public function update($id, $data, $file = null) {
        try {
            // Validasi data
            if (empty($data['title']) || empty($data['description']) || empty($data['category']) || empty($data['date'])) {
                throw new \Exception("Title, description, category, and date are required.");
            }
    
            // Proses file upload jika ada file baru
            $imageUrl = $data['image_url']; // Default ke URL lama
            if ($file && isset($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK) {
                $imageUrl = $this->uploadFile($file);
    
                // Hapus file lama jika ada file baru
                if (!empty($data['image_url'])) {
                    $oldFilePath = __DIR__ . '/../../public/portfolio/' . basename($data['image_url']);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
            }
    
            // Query untuk update data
            $stmt = $this->conn->prepare("UPDATE portfolio SET title = ?, description = ?, image_url = ?, category = ?, date = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $data['title'], $data['description'], $imageUrl, $data['category'], $data['date'], $id);
    
            if (!$stmt->execute()) {
                throw new \Exception("Failed to update portfolio. Error: " . $stmt->error);
            }
    
            echo json_encode(["message" => "Portfolio updated successfully."]);
        } catch (\Exception $e) {
            // Log error dan kembalikan response
            error_log("Update Error: " . $e->getMessage());
            echo json_encode(["error" => "Failed to update portfolio: " . $e->getMessage()]);
        }
    }
    
    

    public function delete($id) {
        // Ambil data untuk mendapatkan URL file sebelum menghapus
        $portfolio = $this->getById($id);
        if ($portfolio) {
            $this->deleteFile($portfolio['image_url']); // Hapus file terkait
        }

        $stmt = $this->conn->prepare("DELETE FROM portfolio WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    // Upload file ke direktori
    private function uploadFile($file) {
        try {
            $uploadDir = __DIR__ . '/../../public/portfolio/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Buat direktori jika belum ada
            }
    
            $fileName = uniqid() . "_" . basename($file['name']);
            $filePath = $uploadDir . $fileName;
    
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                throw new \Exception("Failed to upload file.");
            }
    
            // Kembalikan URL file
            return "http://localhost:8181/portfolio/" . $fileName;
        } catch (\Exception $e) {
            error_log("File Upload Error: " . $e->getMessage());
            throw $e; // Propagasi error ke fungsi pemanggil
        }
    }
    

    // Hapus file dari direktori
    private function deleteFile($imageUrl) {
        $filePath = __DIR__ . '/../public/portfolio/' . basename($imageUrl);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
}
