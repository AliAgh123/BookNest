// Function to display cart items on the checkout page
function displayCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    const totalAmountEl = document.getElementById('total-amount');
    let totalAmount = 0;
  
    cartItemsContainer.innerHTML = ''; // Clear existing content
  
    cart.forEach(item => {
      const itemDiv = document.createElement('div');
      itemDiv.innerHTML = `<span>${item.title}</span><span>Quantity: ${item.quantity}</span>`;
      cartItemsContainer.appendChild(itemDiv);
  
      // Assuming each book has a price of $20 for simplicity
      totalAmount += item.quantity * 20;
    });
  
    totalAmountEl.textContent = `Total: $${totalAmount}`;
  }
  
  // Function to handle form submission
  document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;
  
    // Simple validation
    if (!name || !email || !address) {
      alert('Please fill out all fields.');
      return;
    }
  
    // Clear cart after successful order
    localStorage.removeItem('cart');
    alert('Thank you for your purchase!');
    window.location.href = 'E-LibHomepage.html';
  });
  
  // Initialize cart display on page load
  document.addEventListener('DOMContentLoaded', displayCart);
  