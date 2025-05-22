<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex justify-content-end p-3">
  <div class="dropdown">
    <button
      id="profileButton"
      class="btn dropdown-toggle" style="background-color: #0292B7; color: white;"
      type="button"
      data-bs-toggle="dropdown"
      aria-expanded="false">
      Loading...
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><a class="dropdown-item" href="#">Logout</a></li>
    </ul>
  </div>
</div>

<script>
  const token = localStorage.getItem('token');

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
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
