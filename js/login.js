// js/login.js

// Simple redirect to a registration page
document.getElementById('register-btn').addEventListener('click', () => {
  window.location.href = 'register.html';
});

// Basic form submission handler
document.getElementById('login-form').addEventListener('submit', e => {
  e.preventDefault();
  // TODO: hook up real authentication
  const username = e.target.username.value;
  const password = e.target.password.value;
  alert(`Logging in as "${username}"… (implement auth)`);
});
