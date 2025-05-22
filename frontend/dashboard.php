<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<!-- <style>
    .content1 {
        margin-left: 190px;
        margin-top: 20px;
    }

    .user-info {
        font-size: 18px;
        color: #333;
    }
</style> -->

<body>
    <div class="d-flex flex-column">
        <div style="width:300px;">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="d-flex flex-column" style="width:100%;">
            <?php include 'navbar.php'; ?>
            <div class="user-info p-3" id="user-info">
                <h1>Welcome to the Dashboard</h1>
                <p>This is your dashboard content.</p>
            </div>  
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Logout functionality
        document.addEventListener("DOMContentLoaded", function () {
            const logoutBtn = document.getElementById('logout');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', async function (event) {
                    event.preventDefault();

                    const token = localStorage.getItem('token');
                    if (!token) {
                        alert("Not logged in.");
                        return;
                    }

                    try {
                        const response = await fetch('http://localhost:8000/api/logout', {
                            method: 'POST',
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            localStorage.removeItem('token');
                            window.location.href = "index.php";
                        } else {
                            alert(data.message || "Logout failed");
                        }
                    } catch (error) {
                        console.error('Logout Error:', error);
                        alert("An error occurred. Please try again later.");
                    }
                });
            }

            fetchUserInfo();
        });

        async function fetchUserInfo() {
            const token = localStorage.getItem('token');
            if (!token) {
                alert('User is not authenticated!');
                window.location.href = 'login.php';
                return;
            }

            try {
                const response = await fetch('http://localhost:8000/api/user', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                });

                const data = await response.json();
                console.log("User Info Response:", data);

                if (response.ok) {
                    const userInfoDiv = document.getElementById('user-info');
                    userInfoDiv.innerHTML = `
                        <h1>Welcome, ${data.name}</h1>
                        <p>This is your dashboard content.</p>
                    `;
                } else {
                    console.error('Failed to fetch user info:', data.message);
                    alert('Failed to fetch user info: ' + (data.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error fetching user info:', error);
                alert('An error occurred while fetching user info: ' + error.message);
            }
        }
    </script>
</body>

</html>
