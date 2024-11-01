<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 2 - Pemrograman Website 2024</title>
</head>
<body>
    <h1>Masukkan Bilangan Bulat Positif</h1>
    <form action="" method="POST">
        <label for="number">Input bilangan (n): </label>
        <input type="number" id="number" name="number" required>
        <button type="submit">Submit</button>
    </form>

    <h2>Output:</h2>
    <div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['number'])) {
            require_once 'tugas2.php';
            $number = intval($_POST['number']);
            echo cetakBilangan($number);
        }
        ?>
    </div>
</body>
</html>
