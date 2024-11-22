<?php

namespace app\Controllers;

require_once __DIR__ . '/../Models/Contact.php';

use app\Models\Contact;

class ContactController {
    public function create($data) {
        $contact = new Contact();
        $contact->create($data);
        echo json_encode(["message" => "Message sent successfully."]);
    }

    public function index() {
        $contact = new Contact();
        $data = $contact->getAll();
        echo json_encode($data);
    }
}
