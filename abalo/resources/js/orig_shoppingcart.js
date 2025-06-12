document.addEventListener("DOMContentLoaded", () => {
    const cart = new Set(); // Zum Speichern der Artikel-IDs

    const updateCartDisplay = () => {
        const cartItems = document.getElementById("cart-items");
        cartItems.innerHTML = "";

        cart.forEach((itemId) => {
            const articleRow = document.querySelector(`tr[data-id='${itemId}']`);
            if (articleRow) {
                const listItem = document.createElement("li");
                listItem.textContent = articleRow.querySelector("td:first-child").textContent;

                const removeButton = document.createElement("button");
                removeButton.textContent = "-";
                removeButton.addEventListener("click", () => {
                    cart.delete(itemId);
                    articleRow.querySelector(".add-to-cart").disabled = false;
                    updateCartDisplay();
                });

                listItem.appendChild(removeButton);
                cartItems.appendChild(listItem);
            }
        });
    };

    document.querySelectorAll(".add-to-cart").forEach((button) => {
        button.addEventListener("click", (event) => {
            const articleRow = event.target.closest("tr");
            const articleId = articleRow.getAttribute("data-id");

            if (!cart.has(articleId)) {
                cart.add(articleId);
                event.target.disabled = true; // Deaktiviert den Button
                updateCartDisplay();
            }
        });
    });
});
