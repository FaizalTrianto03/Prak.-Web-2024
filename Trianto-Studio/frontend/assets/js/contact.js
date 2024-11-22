document.addEventListener("DOMContentLoaded", () => {
    const contactSection = document.getElementById("contact");

    // Template HTML untuk bagian Contact
    const contactHTML = `
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <p class="section-description">
                We'd love to hear from you. Whether you have a question or want to start a project, feel free to reach out!
            </p>
            <form id="contact-form" class="contact-form">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn-primary">Send Message</button>
            </form>
        </div>
    `;

    // Inject HTML ke dalam section
    contactSection.innerHTML = contactHTML;

    // Handle Form Submission
    const contactForm = document.getElementById("contact-form");
    contactForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData.entries());

        fetch("http://localhost:8181/api/contact", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(() => {
                alert("Your message has been sent successfully!");
                contactForm.reset(); // Reset semua field di form
            })
            .catch((error) => {
                console.error("Error sending message:", error);
                alert("Failed to send your message. Please try again later.");
                contactForm.reset(); // Tetap reset form meskipun terjadi error
            });
    });
});
