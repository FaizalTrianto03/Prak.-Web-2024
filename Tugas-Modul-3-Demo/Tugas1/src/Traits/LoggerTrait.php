<?php
namespace Project\OOP\Traits;

trait LoggerTrait {
    public function log($message) {
        echo "[LOG]: $message\n";
    }
}
