document.addEventListener("DOMContentLoaded", () => {
    const contactListContainer = document.getElementById("contact-list");

    // Fungsi untuk mengambil data kontak dari API
    function fetchContacts() {
        fetch("http://localhost:8181/api/contact")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.length === 0) {
                    contactListContainer.innerHTML = `
                        <div class="no-contact">
                            <p>No contact information available at the moment.</p>
                        </div>
                    `;
                    return;
                }

                contactListContainer.innerHTML = data
                    .map(contact => `
                        <div class="contact-item">
                            <h3>${contact.name}</h3>
                            <p>Email: <a href="mailto:${contact.email}">${contact.email}</a></p>
                            <p>Message: ${contact.message}</p>
                            <hr>
                        </div>
                    `)
                    .join('');
            })
            .catch(error => {
                console.error("Error fetching contacts:", error);
                contactListContainer.innerHTML = `
                    <div class="error-message">
                        <p>Sorry, something went wrong. Please try again later.</p>
                    </div>
                `;
            });
    }

    // Ambil data kontak saat halaman dimuat
    fetchContacts();
});
