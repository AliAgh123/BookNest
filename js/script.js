  function toggleView(viewType) {
    const bookGrid = document.querySelector('.book-grid');
    const bookItems = document.querySelectorAll('.book-item');
    
    if (viewType === 'list') {
      bookGrid.style.display = 'block';
      bookItems.forEach(item => {
        item.style.display = 'flex';
        item.style.flexDirection = 'row';
        item.style.alignItems = 'center';
        item.style.marginBottom = '1rem';
        item.querySelector('img').style.maxWidth = '150px';
        item.querySelector('img').style.marginRight = '1rem';
      });
    } else {
      bookGrid.style.display = 'grid';
      bookItems.forEach(item => {
        item.style.display = 'block';
        item.style.flexDirection = 'column';
        item.style.alignItems = 'center';
        item.querySelector('img').style.maxWidth = '100%';
        item.querySelector('img').style.marginRight = '0';
      });
    }
  }




function addToCart(bookTitle) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  const existingBook = cart.find(item => item.title === bookTitle);

  if (existingBook) {
    existingBook.quantity += 1;
  } else {
    cart.push({ title: bookTitle, quantity: 1 });
  }
  

  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCount();
}


function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const cartCountElement = document.getElementById('cart-count');
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

  if (totalItems > 0) {
    cartCountElement.textContent = totalItems;
    cartCountElement.classList.remove('hidden');
  } else {
    cartCountElement.classList.add('hidden');
  }
}


function displayCartItems() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const cartContainer = document.getElementById('cart-items-container');
  cartContainer.innerHTML = '';

  if (cart.length === 0) {
    cartContainer.innerHTML = '<p>Your cart is empty!</p>';
    return;
  }

  cart.forEach((item, index) => {
    const div = document.createElement('div');
    div.className = 'cart-item';
    div.innerHTML = `
      <h3>${item.title}</h3>
      <p>Quantity: ${item.quantity}</p>
      <button onclick="removeFromCart(${index})" class="remove-btn">Remove</button>
    `;
    cartContainer.appendChild(div);
  });
}


function removeFromCart(index) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  cart.splice(index, 1); 
  localStorage.setItem('cart', JSON.stringify(cart));
  displayCartItems();
  updateCartCount();
}

function clearCart() {
  localStorage.removeItem('cart');
  displayCartItems();
  updateCartCount();
}


if (window.location.pathname.includes('malak_cart.html')) {
  displayCartItems();
}

document.querySelectorAll('.book-item .buy-btn').forEach(button => {
  button.addEventListener('click', function () {
    const bookTitle = this.parentElement.querySelector('h3').textContent;
    addToCart(bookTitle);
  });
});


document.addEventListener('DOMContentLoaded', updateCartCount);
