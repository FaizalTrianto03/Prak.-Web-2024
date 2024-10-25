<?php
$height = 5; // Tinggi segitiga

for ($i = $height; $i >= 1; $i--) {
    // Cetak spasi untuk membentuk segitiga terbalik
    for ($j = $height; $j > $i; $j--) {
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
