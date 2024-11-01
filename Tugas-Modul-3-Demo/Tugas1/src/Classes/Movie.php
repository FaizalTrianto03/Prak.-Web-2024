<?php
namespace Project\OOP\Classes;

use Project\OOP\Abstracts\ShowItem;

class Movie extends ShowItem {
    private $price;

    public function __construct($title, $showTime, $price) {
        parent::__construct($title, $showTime);
        $this->price = $price;
    }

    public function getDetails() {
        return "Movie: {$this->title}, Show Time: {$this->showTime}, Price: \${$this->price}";
    }

    public function getPrice() {
        return $this->price;
    }
}
