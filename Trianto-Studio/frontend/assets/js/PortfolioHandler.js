document.addEventListener("DOMContentLoaded", () => {
    const portfolioGrid = document.getElementById("portfolio-grid");
    const portfolioForm = document.getElementById("portfolio-form");
    const portfolioIdInput = document.getElementById("portfolio-id");
    const portfolioTitleInput = document.getElementById("portfolio-title");
    const portfolioDescriptionInput = document.getElementById("portfolio-description");
    const portfolioCategoryInput = document.getElementById("portfolio-category");
    const portfolioImageUrlInput = document.getElementById("portfolio-image-url");

    const API_URL = "http://localhost:8181/api/portfolio";

    // Fetch and render portfolio
    const fetchPortfolio = () => {
        fetch(API_URL)
            .then((response) => response.json())
            .then((data) => {
                portfolioGrid.innerHTML = data
                    .map(
                        (item) => `
                        <div class="portfolio-item" data-id="${item.id}">
                            <img src="${item.image_url}" alt="${item.title}" />
                            <div class="portfolio-details">
                                <h3>${item.title}</h3>
                                <p>${item.description}</p>
                                <p><strong>Category:</strong> ${item.category}</p>
                                <button class="edit-btn" data-id="${item.id}">Edit</button>
                                <button class="delete-btn" data-id="${item.id}">Delete</button>
                            </div>
                        </div>
                    `
                    )
                    .join("");
            })
            .catch((error) => console.error("Error fetching portfolio:", error));
    };

    // Handle form submission for create or update
    portfolioForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const id = portfolioIdInput.value;
        const method = id ? "PUT" : "POST";
        const url = id ? `${API_URL}/${id}` : API_URL;

        const data = {
            title: portfolioTitleInput.value,
            description: portfolioDescriptionInput.value,
            category: portfolioCategoryInput.value,
            image_url: portfolioImageUrlInput.value,
        };

        fetch(url, {
            method,
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then(() => {
                alert(`Portfolio ${id ? "updated" : "created"} successfully!`);
                portfolioForm.reset();
                fetchPortfolio();
            })
            .catch((error) => console.error("Error saving portfolio:", error));
    });

    // Handle edit button click
    portfolioGrid.addEventListener("click", (e) => {
        if (e.target.classList.contains("edit-btn")) {
            const id = e.target.dataset.id;

            fetch(`${API_URL}/${id}`)
                .then((response) => response.json())
                .then((data) => {
                    portfolioIdInput.value = data.id;
                    portfolioTitleInput.value = data.title;
                    portfolioDescriptionInput.value = data.description;
                    portfolioCategoryInput.value = data.category;
                    portfolioImageUrlInput.value = data.image_url;
                })
                .catch((error) => console.error("Error fetching portfolio item:", error));
        }
    });

    // Handle delete button click
    portfolioGrid.addEventListener("click", (e) => {
        if (e.target.classList.contains("delete-btn")) {
            const id = e.target.dataset.id;

            if (confirm("Are you sure you want to delete this portfolio item?")) {
                fetch(`${API_URL}/${id}`, { method: "DELETE" })
                    .then(() => {
                        alert("Portfolio item deleted successfully!");
                        fetchPortfolio();
                    })
                    .catch((error) => console.error("Error deleting portfolio item:", error));
            }
        }
    });

    // Initial fetch to populate the portfolio grid
    fetchPortfolio();
});
