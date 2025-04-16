<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
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
        <h1 class="text-center mb-4">Register</h1>
        <form id="registerForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="form-group mt-3">
                <label for="email">Email Address</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group mt-3">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
        </form>
        <div id="registerStatus" class="mt-3 text-center"></div>
    </div>

    <script>
        // Handle registration form submission
        document.getElementById('registerForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                document.getElementById('registerStatus').innerHTML = `<p class="text-danger">Passwords do not match!</p>`;
                return;
            }

            const userData = {
                name: name,
                email: email,
                password: password
            };

            try {
                const response = await fetch('http://127.0.0.1:8000/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userData)
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('registerStatus').innerHTML = `<p class="text-success">Registration successful! You can now <a href="index.php">login</a>.</p>`;
                } else {
                    document.getElementById('registerStatus').innerHTML = `<p class="text-danger">Failed to register: ${data.message}</p>`;
                }
            } catch (error) {
                console.error('Error registering user:', error);
                document.getElementById('registerStatus').innerHTML = `<p class="text-danger">An error occurred while registering. Please try again.</p>`;
            }
        });
    </script>
</body>
</html>