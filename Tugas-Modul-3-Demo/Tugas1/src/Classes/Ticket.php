<?php
namespace Project\OOP\Classes;

use Project\OOP\Traits\LoggerTrait;

class Ticket {
    use LoggerTrait;

    private $movie;
    private $seat;

    public function __construct(Movie $movie, $seat) {
        $this->movie = $movie;
        $this->seat = $seat;
        $this->log("New ticket purchased");
    }

    public function __toString() {
        return "Ticket Details:\n" .
               "{$this->movie->getDetails()}\n" .
               "Seat: {$this->seat} - Enjoy the movie!";
    }
}
