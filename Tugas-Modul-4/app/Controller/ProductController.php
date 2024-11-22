<?php

namespace app\Controller;

require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Traits/ApiResponseFormatter.php';

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController {
    use ApiResponseFormatter;

    public function index() {
        $productModel = new Product();
        $response = $productModel->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id) {
        $productModel = new Product();
        $response = $productModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert() {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        $productModel = new Product();
        $productModel->create($inputData);
        return $this->apiResponse(201, "Product created successfully", null);
    }

    public function update($id) {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        $productModel = new Product();
        $productModel->update($inputData, $id);
        return $this->apiResponse(200, "Product updated successfully", null);
    }

    public function delete($id) {
        $productModel = new Product();
        $productModel->delete($id);
        return $this->apiResponse(200, "Product deleted successfully", null);
    }
}
