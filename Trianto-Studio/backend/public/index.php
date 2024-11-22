<?php

// Menambahkan header CORS untuk mengizinkan akses dari domain tertentu
header("Access-Control-Allow-Origin: *");  // Ganti dengan domain frontend Anda jika diperlukan
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");  // Mengizinkan pengiriman kredensial seperti cookies

// Menangani preflight request (OPTIONS request)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Mendapatkan path dari URL untuk menyesuaikan permintaan gambar
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Menangani permintaan gambar dari folder storage/uploads/portfolio/
if (preg_match('/^\/storage\/uploads\/portfolio\/(.*)$/', $path, $matches)) {
    $imagePath = __DIR__ . '/../storage/uploads/portfolio/' . $matches[1];

    // Periksa apakah file gambar ada
    if (file_exists($imagePath)) {
        // Mengatur header untuk menampilkan gambar dengan tipe MIME yang sesuai
        header('Content-Type: ' . mime_content_type($imagePath));
        readfile($imagePath);  // Membaca dan mengirimkan file gambar ke browser
        exit();
    } else {
        // Jika gambar tidak ditemukan, kirimkan status 404 dan pesan error
        http_response_code(404);
        echo json_encode(["error" => "Image not found"]);
        exit();
    }
}

// Setelah menangani gambar, lanjutkan dengan rute API lainnya
require_once __DIR__ . '/../app/Routes/ApiRoutes.php';

use app\Routes\ApiRoutes;

// Mendapatkan metode HTTP dan path dari URL
$method = $_SERVER['REQUEST_METHOD'];

// Menangani rute untuk permintaan API lainnya
ApiRoutes::handle($method, $path);
?>
