<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
   
</head>
<body>
    <div class="d-flex flex-column" style="width: 100vw;">
        <div class="" style="300px">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="" style="100%">

             <div class="content">
                <div class="container">
                <?php include 'navbar.php'; ?>

                 <div class="content1">
                     <div class="user-info" id="user-info">
                     </div>
                 </div>
                 <h1>Welcome to the Dashboard</h1>
                 <p>This is your dashboard content.</p>
             </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    
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

                const data = await response.json();  // magkuha sa response sa json format

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
        async function fetchUserInfo() { //naghimo og asynchuros funtion para sa fetch
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