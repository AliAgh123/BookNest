function addToCart(bookId, title, price) {
	const data = {
		book_id: bookId,
		title: title,
		price: price,
	};

	fetch("cartHandler.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
		.then((response) => response.json())
		.then((result) => {
			if (result.success) {
				alert("Book added to cart successfully!");
				console.log(result);
			} else {
				alert("Failed to add book to cart.");
			}
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}

function updateCartCount() {
	const cart = JSON.parse(localStorage.getItem("cart")) || [];
	const cartCountElement = document.getElementById("cart-count");
	const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

	if (totalItems > 0) {
		cartCountElement.textContent = totalItems;
		cartCountElement.classList.remove("hidden");
	} else {
		cartCountElement.classList.add("hidden");
	}
}

function displayCartItems() {
	const cart = JSON.parse(localStorage.getItem("cart")) || [];
	const cartContainer = document.getElementById("cart-items-container");
	cartContainer.innerHTML = "";

	if (cart.length === 0) {
		cartContainer.innerHTML = "<p>Your cart is empty!</p>";
		return;
	}

	cart.forEach((item, index) => {
		const div = document.createElement("div");
		div.className = "cart-item";
		div.innerHTML = `
      <h3>${item.title}</h3>
      <p>Quantity: ${item.quantity}</p>
      <button onclick="removeFromCart(${index})" class="remove-btn">Remove</button>
    `;
		cartContainer.appendChild(div);
	});
}

function removeFromCart(index) {
	let cart = JSON.parse(localStorage.getItem("cart")) || [];

	cart.splice(index, 1);
	localStorage.setItem("cart", JSON.stringify(cart));
	displayCartItems();
	updateCartCount();
}

function clearCart() {
	localStorage.removeItem("cart");
	displayCartItems();
	updateCartCount();
}

if (window.location.pathname.includes("malak_cart.html")) {
	displayCartItems();
}

document.querySelectorAll(".product-item button").forEach((button) => {
	button.addEventListener("click", function () {
		const bookTitle = this.parentElement.querySelector("h3").textContent;
		addToCart(bookTitle);
	});
});

document.addEventListener("DOMContentLoaded", updateCartCount);
