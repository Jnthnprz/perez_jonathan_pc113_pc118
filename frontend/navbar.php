<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
</head>
<body>

<!-- Profile Dropdown -->
<div class="d-flex justify-content-end p-3">
  <div class="dropdown">
    <button
      id="profileButton"
      class="btn btn-primary dropdown-toggle"
      type="button"
      data-toggle="dropdown"
      aria-expanded="false"
      style="background-color: #0292B7; color: white; border: none;"
    >
      Loading...
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
    </ul>
  </div>
</div>

<!-- Scripts -->
<script>
  const token = localStorage.getItem('token');

  // Fetch user info if token exists
  if (token) {
    fetch('http://localhost:8000/api/user', {
      headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json'
      }
    })
    .then(response => {
      if (!response.ok) throw new Error('Unauthorized');
      return response.json();
    })
    .then(user => {
      document.getElementById('profileButton').textContent = user.name;
    })
    .catch(error => {
      console.error('Error:', error);
      document.getElementById('profileButton').textContent = 'Guest';
    });
  } else {
    document.getElementById('profileButton').textContent = 'Guest';
  }

  // Logout function
  function logout() {
    localStorage.removeItem('token'); // Remove token
    window.location.href = 'login.php'; // Change if your login page is named differently
  }
</script>

<!-- Bootstrap JS (ensure this is loaded for dropdown to work) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
