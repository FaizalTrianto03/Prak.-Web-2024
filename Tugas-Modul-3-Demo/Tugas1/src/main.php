<?php
require_once __DIR__ . '/Traits/LoggerTrait.php';
require_once __DIR__ . '/Abstracts/ShowItem.php';
require_once __DIR__ . '/Classes/Movie.php';
require_once __DIR__ . '/Classes/Ticket.php';

use Project\OOP\Classes\Movie;
use Project\OOP\Classes\Ticket;

$movie = new Movie("Interstellar", "8:30 PM", 15);
$ticket = new Ticket($movie, "C7");

echo $ticket;
