<?php

namespace app\Controllers;

require_once __DIR__ . '/../Models/Portfolio.php';

use app\Models\Portfolio;

class PortfolioController {

    public function index() {
        try {
            $portfolio = new Portfolio();
            $data = $portfolio->getAll();

            if (empty($data)) {
                echo json_encode(["message" => "No portfolio items found."]);
            } else {
                echo json_encode($data);
            }
        } catch (\Exception $e) {
            echo json_encode(["error" => "Failed to fetch portfolio data: " . $e->getMessage()]);
        }
    }

    public function show($id) {
        try {
            $portfolio = new Portfolio();
            $data = $portfolio->getById($id);

            if ($data) {
                echo json_encode($data);
            } else {
                echo json_encode(["error" => "Portfolio item not found with ID: $id"]);
            }
        } catch (\Exception $e) {
            echo json_encode(["error" => "Failed to fetch portfolio item: " . $e->getMessage()]);
        }
    }

    public function create() {
        try {
            $uploadDir = __DIR__ . '/../../public/portfolio/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileName = uniqid() . "_" . basename($_FILES['image']['name']);
                $filePath = $uploadDir . $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], $filePath);

                $data = [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'image_url' => "$fileName",
                    'category' => $_POST['category'],
                    'date' => date('Y-m-d')
                ];

                $portfolio = new Portfolio();
                $portfolio->create($data);
                echo json_encode(["message" => "Portfolio created successfully."]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Image upload failed."]);
            }
        } catch (\Exception $e) {
            echo json_encode(["error" => "Failed to create portfolio: " . $e->getMessage()]);
        }
    }

    public function update($id) {
        try {
            $portfolio = new Portfolio();
            $existingItem = $portfolio->getById($id);
    
            if (!$existingItem) {
                http_response_code(404);
                echo json_encode(["error" => "Portfolio item not found with ID: $id"]);
                return;
            }
    
            // Parsing data dari multipart/form-data (untuk PUT)
            $input = [];
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                $input = $this->parseMultipartFormData();
            } else {
                $input = $_POST;
            }
    
            // Debug log untuk memastikan data diterima
            error_log("Parsed Input: " . print_r($input, true));
            error_log("FILES: " . print_r($_FILES, true));
    
            $uploadDir = __DIR__ . '/../../public/portfolio/';
            $fileName = basename($existingItem['image_url']); // Default ke file lama
    
            // Proses file upload jika file baru diberikan
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $newFileName = uniqid() . "_" . basename($_FILES['image']['name']);
                $newFilePath = $uploadDir . $newFileName;
    
                // Buat direktori jika belum ada
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                // Pindahkan file yang diunggah
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $newFilePath)) {
                    throw new \Exception("Failed to upload new image.");
                }
    
                // Hapus file lama jika ada file baru
                $oldFilePath = $uploadDir . $fileName;
                if (file_exists($oldFilePath) && $fileName !== $newFileName) {
                    unlink($oldFilePath);
                }
    
                // Simpan nama file baru
                $fileName = $newFileName;
            }
    
            // Validasi data input
            if (empty($input['title']) || empty($input['description']) || empty($input['category'])) {
                http_response_code(400);
                echo json_encode(["error" => "Title, description, and category are required."]);
                return;
            }
    
            // Siapkan data untuk update
            $data = [
                'title' => $input['title'],
                'description' => $input['description'],
                'image_url' => $fileName, // Tetap gunakan nama file (baru atau lama)
                'category' => $input['category'],
                'date' => date('Y-m-d') // Bisa gunakan tanggal lama jika tidak diubah
            ];
    
            // Debug log data yang akan diperbarui
            error_log("Update Data: " . print_r($data, true));
    
            $portfolio->update($id, $data);
            echo json_encode(["message" => "Portfolio updated successfully."]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Failed to update portfolio: " . $e->getMessage()]);
        }
    }
    
    
    
    

    private function parseMultipartFormData() {
        $parsed = [];
        $input = fopen('php://input', 'r');
        $rawData = stream_get_contents($input);
        fclose($input);
    
        // Parsing boundary dari header Content-Type
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        $boundary = $matches[1];
    
        if ($boundary) {
            // Memecah data berdasarkan boundary
            $blocks = preg_split("/-+$boundary/", $rawData);
            array_pop($blocks); // Hapus elemen kosong terakhir
    
            foreach ($blocks as $block) {
                if (empty($block)) continue;
    
                // Memisahkan header dan konten
                list($headers, $content) = explode("\r\n\r\n", $block, 2);
    
                // Parsing nama field
                preg_match('/name="([^"]*)"/', $headers, $matches);
                $name = $matches[1] ?? null;
    
                if ($name) {
                    $parsed[$name] = trim($content);
                }
            }
        }
    
        return $parsed;
    }
    
    
    

    public function delete($id) {
        try {
            $portfolio = new Portfolio();
            $item = $portfolio->getById($id);

            if (!$item) {
                http_response_code(404);
                echo json_encode(["error" => "Portfolio item not found with ID: $id"]);
                return;
            }

            $filePath = __DIR__ . '/../../public/' . $item['image_url'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $portfolio->delete($id);
            echo json_encode(["message" => "Portfolio deleted successfully."]);
        } catch (\Exception $e) {
            echo json_encode(["error" => "Failed to delete portfolio: " . $e->getMessage()]);
        }
    }
}
