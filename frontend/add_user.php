<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .container {
      margin-top: 50px;
      max-width: 600px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1 class="text-center mb-4">Add New User</h1>
    <form id="addUserForm">
      <div class="form-group">
        <label for="addName">Name</label>
        <input type="text" class="form-control" id="addName" required>
      </div>
      <div class="form-group">
        <label for="addEmail">Email</label>
        <input type="email" class="form-control" id="addEmail" required>
      </div>
      <div class="form-group">
        <label for="addPassword">Password</label>
        <input type="password" class="form-control" id="addPassword" required>
      </div>
      <div class="form-group">
        <label for="addRole">Role</label>
        <select class="form-control" id="addRole" required>
          <option value="1">Admin</option>
          <option value="3">Cashier</option>
          <option value="2">Customer</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary btn-block mt-3">Add User</button>
    </form>
    <div class="text-center mt-3">
      <a href="user.php" class="btn btn-secondary">Back to User List</a>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- KEEP YOUR ORIGINAL STYLES & HTML STRUCTURE -->

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('addUserForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const newUser = {
      name: document.getElementById('addName').value,
      email: document.getElementById('addEmail').value,
      password: document.getElementById('addPassword').value,
      role: document.getElementById('addRole').value,
    };

    fetch('http://127.0.0.1:8000/api/users', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(newUser)
    })
    .then(response => response.json().then(data => {
      if (!response.ok) throw data;
      Swal.fire('Success!', 'User added successfully.', 'success')
           .then(() => window.location.href = 'user.php');
    }))
    .catch(error => {
      console.error('Add error:', error);
      Swal.fire('Error!', error.message || 'Failed to add user.', 'error');
    });
  });
});
</script>

</body>
</html>
