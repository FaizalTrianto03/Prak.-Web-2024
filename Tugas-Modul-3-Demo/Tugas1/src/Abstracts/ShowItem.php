<?php
namespace Project\OOP\Abstracts;

abstract class ShowItem {
    protected $title;
    protected $showTime;

    public function __construct($title, $showTime) {
        $this->title = $title;
        $this->showTime = $showTime;
    }

    abstract public function getDetails();
}
