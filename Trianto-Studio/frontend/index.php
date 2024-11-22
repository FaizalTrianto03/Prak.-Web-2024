<?php
// Menambahkan header CORS untuk mengizinkan akses dari semua domain
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trianto Studio</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="assets/js/portfolio.js" defer></script>
    <script src="assets/js/testimonials.js" defer></script>
    <script src="assets/js/contact.js" defer></script>
    <script>
        // Smooth Scrolling for Navigation
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener("click", function(e) {
                    e.preventDefault();

                    const target = document.querySelector(this.getAttribute("href"));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - document.querySelector(".header").offsetHeight,
                            behavior: "smooth"
                        });
                    }
                });
            });

            // Highlight Active Section in Navbar
            const sections = document.querySelectorAll("section");
            const navLinks = document.querySelectorAll(".navbar ul li a");

            window.addEventListener("scroll", () => {
                let current = "";
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - document.querySelector(".header").offsetHeight;
                    if (scrollY >= sectionTop - 50) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === `#${current}`) {
                        link.classList.add("active");
                    }
                });
            });
        });
    </script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo"><a href="#home">Trianto Studio</a></div>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-icon"><i class="fas fa-bars"></i></label>
        <nav class="navbar">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section (Home) -->
    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">Where Creativity Meets Innovation</h1>
                <p class="hero-description">Transforming brands into experiences through modern UI/UX design.</p>
                <div class="hero-buttons">
                    <a href="#portfolio" class="btn btn-primary">Explore Our Work</a>
                    <a href="#contact" class="btn btn-secondary">Let's Collaborate</a>
                </div>
            </div>
            <div class="hero-action">
                <img src="assets/img/hero-image.png" alt="Hero Image" class="hero-image">
            </div>
        </div>
    </section>

       <!-- Our Services Section -->
       <section id="services" class="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <p class="section-description">Crafting seamless digital experiences tailored to your needs.</p>
            <div class="service-cards">
                <div class="card">
                    <i class="fas fa-pencil-alt"></i>
                    <h3>UI/UX Design</h3>
                    <p>We design intuitive and visually stunning interfaces for your digital products.</p>
                </div>
                <div class="card">
                    <i class="fas fa-project-diagram"></i>
                    <h3>Prototyping</h3>
                    <p>From ideas to clickable prototypes, we help visualize your concept.</p>
                </div>
                <div class="card">
                    <i class="fas fa-users"></i>
                    <h3>User Testing</h3>
                    <p>Optimize user experience through rigorous testing and feedback.</p>
                </div>
                <div class="card">
                    <i class="fas fa-magic"></i>
                    <h3>Interaction Design</h3>
                    <p>We create engaging animations and interactions to enhance the user journey.</p>
                </div>
                <div class="card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Responsive Design</h3>
                    <p>Our designs adapt seamlessly across all devices, ensuring a flawless experience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <h2 class="section-title">Our Portfolio</h2>
            <p class="section-description">Explore our creative projects crafted with precision and care.</p>
            <div id="portfolio-grid" class="portfolio-grid">
                <!-- Portfolio items will be injected by JavaScript -->
            </div>
            <div class="see-more">
                <a href="portfolio.php" class="btn btn-secondary">Manage Portfolio</a>
            </div>

        </div>
    </section>

  <!-- Testimonials Section -->
<section id="testimonials" class="testimonials">
    <h2 class="section-title">What Our Clients Say</h2>
    <p class="section-description">We value the feedback from our clients. Here's what they have to say:</p>
    
   

    <!-- Testimonials Grid -->
    <div id="testimonials-grid" class="testimonials-grid">
        <!-- Testimonial items will be injected by JavaScript -->
    </div>

     <!-- Form Section -->
     <div id="testimonial-form-container" class="testimonial-form-container">
        <!-- Form will be injected by JavaScript -->
    </div>
    
    <!-- See More Button -->
    <div class="see-more">
        <a href="testimonials.php" class="btn btn-secondary">See More</a>
    </div>
</section>


    <!-- Contact Section -->
    <section id="contact" class="contact"></section>

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