// js/build.js

// helper: read/write cart
function getCart() {
  return JSON.parse(localStorage.getItem('cart') || '[]');
}
function setCart(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}
function updateBadge() {
  const count = getCart().length;
  document.getElementById('cart-count').textContent = count;
}

// on page load, show current badge
updateBadge();

document.getElementById('build-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const favourites = Array.from(document.querySelectorAll('.ingredient-checkbox:checked'))
    .map(cb => cb.value);

  const order = {
    favourites,
    extraItem:   document.getElementById('item').value,
    sugar:       document.getElementById('sugar').value + ' tsp',
    milk:        document.querySelector('input[name="milk"]:checked').value,
    water:       document.querySelector('input[name="water"]:checked').value,
    syrup:       document.querySelector('input[name="syrup"]:checked').value,
    price:       favourites.length * 5 + 5  // example pricing logic
  };

  // add to localStorage cart
  const cart = getCart();
  cart.push(order);
  setCart(cart);

  // update badge & redirect
  updateBadge();
  window.location.href = 'cart.html';
});
