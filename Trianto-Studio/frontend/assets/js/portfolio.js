document.addEventListener("DOMContentLoaded", () => {
    const portfolioContainer = document.getElementById("portfolio-grid");

    // Melakukan fetch data portfolio dari API
    fetch("http://localhost:8181/api/portfolio", {
        method: "GET"
    })
        .then(response => {
            console.log("Response status:", response.status);

            // Menangani jika status HTTP bukan 200 (OK)
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            // Mengembalikan hasil dalam format JSON
            return response.json();
        })
        .then(data => {
            console.log("Fetched data:", data);

            // Memeriksa apakah data portfolio kosong
            if (data.length === 0) {
                portfolioContainer.innerHTML =
                    "<p>No portfolio items available at the moment.</p>";
                return;
            }

            // Menampilkan data portfolio ke dalam container
            portfolioContainer.innerHTML = data
                .map(item => {
                    // Membuat URL gambar
                    const imageUrl = item.image_url.includes("portfolio")
                        ? `http://localhost:8181/portfolio/${item.image_url
                              .split("/")
                              .pop()}`
                        : item.image_url;

                    // Format tanggal menjadi "11 November, 2024"
                    const formattedDate = new Date(item.date).toLocaleDateString(
                        "id-ID",
                        {
                            day: "numeric",
                            month: "long",
                            year: "numeric"
                        }
                    );

                    return `
                    <div class="portfolio-item">
                        <div class="portfolio-category">${item.category}</div>
                        <img 
                            src="${imageUrl}" 
                            alt="${item.title}" 
                            class="portfolio-image" 
                            onerror="this.onerror=null;this.src='assets/img/placeholder.jpg';">
                        <div class="portfolio-details">
                            <h3>${item.title}</h3>
                            <p>${item.description}</p>
                        </div>
                        <div class="divider"></div> <!-- Divider -->
                        <div class="portfolio-date">${formattedDate}</div>
                    </div>
                    `;
                })
                .join(""); // Gabungkan item portfolio menjadi satu string HTML
        })
        .catch(error => {
            // Menangani kesalahan saat mengambil data
            console.error("Error fetching portfolio data:", error);
            portfolioContainer.innerHTML = `<p>Failed to load portfolio items. Please try again later.</p>`;
        });
});
