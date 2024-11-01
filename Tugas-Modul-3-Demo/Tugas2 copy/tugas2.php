<?php
function cetakBilangan($n) {
    $output = "";
    for ($i = 1; $i <= $n; $i++) {
        if ($i % 4 == 0 && $i % 6 == 0) {
            $output .= "Pemrograman Website 2024<br>";
        } elseif ($i % 5 == 0) {
            $output .= "2024<br>";
        } elseif ($i % 4 == 0) {
            $output .= "Pemrograman<br>";
        } elseif ($i % 6 == 0) {
            $output .= "Website<br>";
        } else {
            $output .= "$i<br>";
        }
    }
    return $output;
}
