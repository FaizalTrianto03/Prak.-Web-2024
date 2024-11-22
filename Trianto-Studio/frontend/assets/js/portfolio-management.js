document.addEventListener("DOMContentLoaded", () => {
    const apiUrl = "http://localhost:8181/api/portfolio";
    const portfolioGrid = document.getElementById("portfolio-management-grid");
    const formContainer = document.querySelector(".portfolio-management-form-container");

    // Fungsi untuk membuat form secara dinamis
    function renderForm(mode = "create", data = null) {
        formContainer.innerHTML = `
            <form id="portfolio-form" enctype="multipart/form-data">
                <input type="hidden" name="id" id="portfolio-id" value="${data ? data.id : ""}" />

                <div class="form-group">
                    <label for="portfolio-title">Project Title</label>
                    <input type="text" name="title" id="portfolio-title" placeholder="Enter project title" value="${data ? data.title : ""}" required />
                </div>

                <div class="form-group">
                    <label for="portfolio-description">Project Description</label>
                    <textarea name="description" id="portfolio-description" placeholder="Enter project description" rows="4" required>${data ? data.description : ""}</textarea>
                </div>

                <div class="form-group">
                    <label for="portfolio-category">Category</label>
                    <input type="text" name="category" id="portfolio-category" placeholder="Enter category" value="${data ? data.category : ""}" required />
                </div>

                <div class="form-group">
                    <label for="portfolio-image">Upload Image</label>
                    <input type="file" name="image" id="portfolio-image" accept="image/*" ${mode === "create" ? "required" : ""}>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="portfolio-submit">${mode === "create" ? "Save Portfolio" : "Update Portfolio"}</button>
                    <button type="button" class="btn btn-secondary" id="portfolio-cancel">Cancel</button>
                </div>
            </form>
        `;

        // Event listener untuk tombol Cancel
        document.getElementById("portfolio-cancel").addEventListener("click", () => {
            renderForm("create"); // Reset ke mode Create
        });

        // Event listener untuk form submit
        document.getElementById("portfolio-form").addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(e.target);
            const id = formData.get("id");

            if (id) {
                try {
                    // 1. Hapus data lama berdasarkan ID
                    const deleteResponse = await fetch(`${apiUrl}/${id}`, { method: "DELETE" });
                    if (!deleteResponse.ok) {
                        throw new Error("Gagal menghapus data lama.");
                    }
                    console.log(`Data lama dengan ID ${id} berhasil dihapus.`);
                } catch (error) {
                    console.error("Error deleting portfolio:", error);
                    alert("Gagal menghapus data lama.");
                    return;
                }
            }

            try {
                // 2. Buat data baru
                const createResponse = await fetch(apiUrl, {
                    method: "POST",
                    body: formData,
                });

                if (!createResponse.ok) {
                    throw new Error("Gagal membuat data baru.");
                }

                const result = await createResponse.json();
                console.log("Data baru berhasil dibuat:", result);

                // Refresh daftar portofolio
                fetchPortfolios();

                // Reset form ke mode create
                renderForm("create");

            } catch (error) {
                console.error("Error creating new portfolio:", error);
                alert("Gagal membuat data baru.");
            }
        });
    }

    // Fungsi untuk mendapatkan data portfolio
    function fetchPortfolios(query = "") {
        const url = query ? `${apiUrl}?query=${encodeURIComponent(query)}` : apiUrl;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error("Failed to fetch portfolios.");
                return response.json();
            })
            .then(data => {
                if (data.message) {
                    portfolioGrid.innerHTML = `<p>${data.message}</p>`;
                } else {
                    portfolioGrid.innerHTML = data.map(item => `
                        <div class="portfolio-management-item">
                            <img src="${item.image_url}" alt="${item.title}">
                            <h3>${item.title}</h3>
                            <p>${item.description}</p>
                            <p class="portfolio-management-category">${item.category}</p>
                            <div class="portfolio-management-action-buttons">
                                <button class="portfolio-management-edit-btn" data-id="${item.id}">Edit</button>
                                <button class="portfolio-management-delete-btn" data-id="${item.id}">Hapus</button>
                            </div>
                        </div>
                    `).join('');

                    // Tambahkan event listener untuk tombol Edit
                    document.querySelectorAll(".portfolio-management-edit-btn").forEach(button => {
                        button.addEventListener("click", () => {
                            const id = button.getAttribute("data-id");
                            editPortfolio(id);
                        });
                    });

                    // Tambahkan event listener untuk tombol Hapus
                    document.querySelectorAll(".portfolio-management-delete-btn").forEach(button => {
                        button.addEventListener("click", () => {
                            const id = button.getAttribute("data-id");
                            deletePortfolio(id);
                        });
                    });
                }
            })
            .catch(error => console.error("Error fetching portfolios:", error));
    }

    // Fungsi untuk mengisi form dengan data item yang akan diedit
    function editPortfolio(id) {
        fetch(`${apiUrl}/${id}`, { method: "GET" })
            .then(response => {
                if (!response.ok) throw new Error("Failed to fetch portfolio data.");
                return response.json();
            })
            .then(data => {
                renderForm("update", data); // Render form dengan data untuk mode Update
            })
            .catch(error => console.error("Error editing portfolio:", error));
    }

    // Fungsi untuk menghapus portfolio
    function deletePortfolio(id) {
        fetch(`${apiUrl}/${id}`, { method: "DELETE" })
            .then(response => {
                if (!response.ok) throw new Error("Failed to delete portfolio.");
                return response.json();
            })
            .then(() => {
                fetchPortfolios(); // Refresh daftar portfolio setelah penghapusan
            })
            .catch(error => console.error("Error deleting portfolio:", error));
    }

    // Fetch portfolios saat halaman dimuat
    fetchPortfolios();

    // Render form awal dalam mode Create
    renderForm("create");
});
