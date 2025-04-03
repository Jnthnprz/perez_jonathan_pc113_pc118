<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f4f4f4;
        }
        .navbar {
            width: 100%;
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: right;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            height: 100vh;
            padding-top: 60px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar2 {
            overflow-y: auto;
            color: #ecf0f1;
            align-items: center;
            padding: 15px 20px;
            text-align: center;
            font-size: 20px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: #ecf0f1;
            padding: 15px 20px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }
        .sidebar a svg {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #34495e;
            color: #ecdbff;
        }
        .sidebar a.active {
            background-color: #1abc9c;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 80px;
            width: calc(100% - 250px);
        }
        .content h1 {
            font-size: 28px;
            color: #333;
        }
        .content p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
   <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <div class="content1">
            <div class="user-info" id="user-info">
            </div>
        </div>
        <h1>Welcome to the Dashboard</h1>
        <p>This is your dashboard content.</p>
    </div>
    <script>
        document.getElementById('logout').addEventListener('click', async function(event) {
            event.preventDefault();
            try {
                const response = await fetch('http://localhost:8000/api/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'include' 
                });

                const data = await response.json();

                if (response.ok) {
                    window.location.href = "index.php"; 
                } else {
                    alert(data.message || "Logout failed");
                }
            } catch (error) {
                console.error('Error:', error);
                alert("An error occurred. Please try again later.");
            }
        });

        // Fetch user info
        async function fetchUserInfo() {
            try {
                const response = await fetch('http://localhost:8000/api/user', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'include' 
                });

                const data = await response.json();

                if (response.ok) {
                    const userInfoDiv = document.getElementById('user-info');
                    userInfoDiv.innerHTML = `Logged in as: ${data.name} (${data.email})`;
                } else {
                    console.error('Failed to fetch user info:', data.message);
                }
            } catch (error) {
                console.error('Error fetching user info:', error);
            }
        }


        fetchUserInfo();
    </script>
</body>
</html>