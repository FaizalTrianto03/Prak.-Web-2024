<?php

namespace app\Routes;

require_once __DIR__ . '/../Controllers/PortfolioController.php';
require_once __DIR__ . '/../Controllers/ContactController.php';
require_once __DIR__ . '/../Controllers/TestimonialController.php';
require_once __DIR__ . '/../Controllers/TeamController.php';

use app\Controllers\PortfolioController;
use app\Controllers\ContactController;
use app\Controllers\TestimonialController;
use app\Controllers\TeamController;

class ApiRoutes {
    public static function handle($method, $path) {
        $pathParts = explode("/", trim($path, "/"));

        // Portfolio Routes
        if ($pathParts[0] === "api" && $pathParts[1] === "portfolio") {
            $controller = new PortfolioController();
        
            if ($method === "GET" && count($pathParts) === 2) {
                $controller->index();
            } elseif ($method === "GET" && count($pathParts) === 3) {
                $controller->show($pathParts[2]);
            } elseif ($method === "POST") {
                // Tangani data dari JSON atau FormData
                $input = json_decode(file_get_contents('php://input'), true);
                if (!$input) {
                    $input = $_POST; // Tangani data dari FormData
                }
        
                $controller->create($input);
            } elseif ($method === "PUT" && count($pathParts) === 3) {
                // Tangani data dari JSON atau FormData
                $input = json_decode(file_get_contents('php://input'), true);
                if (!$input) {
                    $input = $_POST; // Tangani data dari FormData
                }
        
                // Debug log untuk memastikan data diterima
                error_log("PUT Request Data: " . print_r($input, true));
        
                $controller->update($pathParts[2], $input);
            } elseif ($method === "DELETE" && count($pathParts) === 3) {
                $controller->delete($pathParts[2]); // Route untuk delete Portfolio
            }
        }
        
        

        // Contact Routes
        if ($pathParts[0] === "api" && $pathParts[1] === "contact") {
            $controller = new ContactController();

            if ($method === "GET") {
                $controller->index();
            } elseif ($method === "POST") {
                $input = json_decode(file_get_contents('php://input'), true);
                $controller->create($input);
            }
        }

        // Testimonial Routes
        if ($pathParts[0] === "api" && $pathParts[1] === "testimonials") {
            $controller = new TestimonialController();

            if ($method === "GET") {
                $controller->index();
            } elseif ($method === "POST") {
                $input = json_decode(file_get_contents('php://input'), true);
                $controller->create($input);
            } elseif ($method === "DELETE" && count($pathParts) === 3) {
                $controller->delete($pathParts[2]); // Route untuk delete Testimonial
            }
        }

        // Team Routes
        if ($pathParts[0] === "api" && $pathParts[1] === "team") {
            $controller = new TeamController();

            if ($method === "GET") {
                $controller->index();
            } elseif ($method === "POST") {
                $input = json_decode(file_get_contents('php://input'), true);
                $controller->create($input);
            } elseif ($method === "DELETE" && count($pathParts) === 3) {
                $controller->delete($pathParts[2]); // Route untuk delete Team
            }
        }
    }
}
