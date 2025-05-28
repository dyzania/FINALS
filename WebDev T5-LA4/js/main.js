let users = JSON.parse(localStorage.getItem('users')) || [];

document.getElementById('signupForm')?.addEventListener('submit', function(e) {
  e.preventDefault();

  const email = document.getElementById('signup-email').value;
  const password = document.getElementById('signup-password').value;
  const confirm = document.getElementById('signup-confirm').value;

  if (password === confirm) {
    users.push({ email, password });
    localStorage.setItem('users', JSON.stringify(users));
    alert("Sign Up successful!");
    window.location.href = 'logIn.html';
  } else {
    alert("Passwords do not match.");
  }
});

document.getElementById('loginForm')?.addEventListener('submit', function(e) {
  e.preventDefault();
  
  const username = document.getElementById('login-username').value;
  const password = document.getElementById('login-password').value;

  users = JSON.parse(localStorage.getItem('users')) || [];

  const userFound = users.find(u => u.email === username && u.password === password);

  if (userFound) {
    window.location.href = 'loggedIn.html';
  } else {
    alert("Invalid login credentials.");
  }
});
