<?php

namespace app\Traits;

trait ApiResponseFormatter {
    public function apiResponse($code = 200, $message = "success", $data = []) {
        http_response_code($code);
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
