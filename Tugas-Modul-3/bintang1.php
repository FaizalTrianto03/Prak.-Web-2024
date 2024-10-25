<?php
$height = 5; // Tinggi segitiga

for ($i = 1; $i <= $height; $i++) {
    // Cetak spasi untuk membentuk segitiga sama sisi
    for ($j = $i; $j < $height; $j++) {
        echo " ";
    }

    // Cetak bintang dalam kelipatan ganjil
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }

    // Pindah ke baris berikutnya
    echo PHP_EOL;
}
?>
