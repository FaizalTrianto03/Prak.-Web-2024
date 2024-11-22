<?php

namespace app\Controllers;

require_once __DIR__ . '/../Models/Testimonial.php';

use app\Models\Testimonial;

class TestimonialController {
    public function index() {
        $testimonial = new Testimonial();
        $data = $testimonial->getAll();
        echo json_encode($data);
    }

    public function create($data) {
        $testimonial = new Testimonial();
        $testimonial->create($data);
        echo json_encode(["message" => "Testimonial added successfully."]);
    }

    public function delete($id) {
        $testimonial = new Testimonial();
        $testimonial->delete($id);
        echo json_encode(["message" => "Testimonial deleted successfully."]);
    }
}
