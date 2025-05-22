<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .profile-wrapper {
      margin: 50px 10px;
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }
    .profile-box {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 380px;
      min-height: 200px;
      margin-left: 40%;
      margin-top: 20px;
    }
    .userinfo, .information {
      padding: 15px;
      border-radius: 8px;
      background-color: #f8f9fa;
      border: 1px solid #ddd;
    }
    .userinfo h2 {
      font-size: 24px;
      font-weight: bold;
      color: #343a40;
    }
    .information p {
      margin: 5px 0;
      font-size: 16px;
      color: #495057;
    }
  </style>
</head>
<body>
  <?php include 'sidebar.php'; ?>

    <div class="profile-box">
      <h3 class="text-center mb-3">User Profile</h3>
      <div class="userinfo" id="userinfo">
        <h2>Loading user information...</h2>
      </div>
    </div>

   

  <script>
    async function fetchUserInfo() {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/view', {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });

    if (!response.ok) {
      throw new Error('Failed to fetch user information');
    }

    const data = await response.json();

    if (data.firstname && data.lastname && data.email) {
      document.getElementById('userinfo').innerHTML = `
        <h2>Welcome, ${data.firstname} ${data.lastname}</h2>
      `;
      document.getElementById('information').innerHTML = `
        <p><strong>First Name:</strong> ${data.firstname}</p>
        <p><strong>Last Name:</strong> ${data.lastname}</p>
        <p><strong>Email:</strong> ${data.email}</p>
        <p><strong>Role:</strong> ${data.role || 'N/A'}</p>
        <p><strong>Joined:</strong> ${new Date(data.created_at).toLocaleDateString()}</p>
      `;
    } else {
      document.getElementById('userinfo').innerHTML = `<h2 class="text-danger">Failed to load user information.</h2>`;
    }
  } catch (error) {
    console.error('Error fetching user information:', error);
    document.getElementById('userinfo').innerHTML = `<h2 class="text-danger">An error occurred while fetching user information.</h2>`;
  }
}

// Call the function after page load
fetchUserInfo();
  </script>
</body>
</html>
