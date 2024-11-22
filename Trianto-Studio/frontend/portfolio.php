<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Management - Trianto Studio</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Tetap menggunakan style.css -->
    <link rel="stylesheet" href="assets/css/portfolio-management.css"> <!-- CSS baru dengan nama class unik -->
    <script src="assets/js/portfolio-management.js" defer></script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo"><a href="index.php">Trianto Studio</a></div>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="portfolio.php" class="active">Portfolio</a></li>
                <li><a href="testimonials.php">Testimonials</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Portfolio Management Section -->
    <section class="portfolio-management-section" id="portfolio-management">
        <div class="portfolio-management-container">
            <header class="portfolio-management-header">
                <h2 class="portfolio-management-title">Portfolio Management</h2>
                <p class="portfolio-management-description">Manage your portfolio projects below:</p>
            </header>

            <!-- Placeholder Form akan diinject JavaScript -->
            <div class="portfolio-management-form-container">
                <!-- Form diisi secara dinamis oleh JavaScript -->
            </div>

            <!-- Grid untuk menampilkan portfolio -->
            <div id="portfolio-management-grid" class="portfolio-management-grid">
                <!-- Portfolio items akan diisi oleh JavaScript -->
            </div>
        </div>
    </section>

       <!-- Footer -->
       <footer class="footer">
        <div class="footer-content">
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
            </div>
            <p>&copy; 2024 Trianto Studio | Designing Tomorrow</p>
        </div>
    </footer>
</body>

</html>
