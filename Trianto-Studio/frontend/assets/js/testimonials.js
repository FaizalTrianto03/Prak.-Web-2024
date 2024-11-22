document.addEventListener("DOMContentLoaded", () => {
    const testimonialsContainer = document.getElementById("testimonials-grid");
    const testimonialFormContainer = document.getElementById("testimonial-form-container");

    // Fungsi untuk fetch testimonial
    function fetchTestimonials() {
        fetch("http://localhost:8181/api/testimonials")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.length === 0) {
                    testimonialsContainer.innerHTML = `
                        <div class="no-testimonials">
                            <p>No testimonials available right now. Be the first to leave one!</p>
                        </div>
                    `;
                    return;
                }

                testimonialsContainer.innerHTML = data
                    .map(item => `
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                <p>"${item.testimonial}"</p>
                            </div>
                            <div class="testimonial-client">
                                <h4>- ${item.client_name}</h4>
                            </div>
                        </div>
                    `)
                    .join('');
            })
            .catch(error => {
                console.error("Error fetching testimonials:", error);
                testimonialsContainer.innerHTML = `
                    <div class="error-message">
                        <p>Sorry, something went wrong. Please try again later.</p>
                    </div>
                `;
            });
    }

    // Fungsi untuk menampilkan form
    function renderTestimonialForm() {
        testimonialFormContainer.innerHTML = `
            <form id="testimonial-form">
                <div class="form-group">
                    <label for="client-name">Your Name</label>
                    <input type="text" id="client-name" name="client_name" placeholder="Enter your name" required />
                </div>
                <div class="form-group">
                    <label for="testimonial-text">Your Testimonial</label>
                    <textarea id="testimonial-text" name="testimonial" placeholder="Enter your testimonial" rows="4" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit Testimonial</button>
                </div>
            </form>
        `;

        // Tambahkan event listener untuk form
        document.getElementById("testimonial-form").addEventListener("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = {
                client_name: formData.get("client_name"),
                testimonial: formData.get("testimonial"),
                date: new Date().toISOString().split("T")[0], // Format tanggal (YYYY-MM-DD)
            };

            fetch("http://localhost:8181/api/testimonials", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Failed to submit testimonial.");
                    }
                    return response.json();
                })
                .then(result => {
                    alert(result.message || "Testimonial added successfully.");
                    fetchTestimonials(); // Refresh daftar testimonial
                    e.target.reset(); // Reset form
                })
                .catch(error => {
                    console.error("Error submitting testimonial:", error);
                    alert("Failed to submit your testimonial. Please try again.");
                });
        });
    }

    // Render form dan fetch testimonial saat halaman dimuat
    renderTestimonialForm();
    fetchTestimonials();
});
