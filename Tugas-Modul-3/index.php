<?php
include "Codelab/Controllers/ProductController.php";


use Controller\ProductController;

$productController = new ProductController();
echo $productController->getAllProduct();
