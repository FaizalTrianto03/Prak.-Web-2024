<?php

namespace app\Controllers;

require_once __DIR__ . '/../Models/Team.php';

use app\Models\Team;

class TeamController {
    public function index() {
        $team = new Team();
        $data = $team->getAll();
        echo json_encode($data);
    }

    public function create($data) {
        $team = new Team();
        $team->create($data);
        echo json_encode(["message" => "Team member added successfully."]);
    }

    public function delete($id) {
        $team = new Team();
        $team->delete($id);
        echo json_encode(["message" => "Team member deleted successfully."]);
    }
}
