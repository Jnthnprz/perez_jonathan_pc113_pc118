<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
   body {
            margin: 0;
            padding: 0;
            background: #0292B7;;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
   .container{
        display: flex;
        align-items: center;
    }
    .form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 350px;
  background-color: #fff;
  padding: 20px;
  border-radius: 20px;
  position: relative;
}

.title {
  font-size: 28px;
  color: royalblue;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: royalblue;
}

.title::before {
  width: 18px;
  height: 18px;
  background-color: royalblue;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.message, .signin {
  color: rgba(88, 87, 87, 0.822);
  font-size: 14px;
}

.signin {
  text-align: center;
}

.signin a {
  color: royalblue;
}

.signin a:hover {
  text-decoration: underline royalblue;
}

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form label .input {
  width: 100%;
  padding: 10px 10px 20px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .input + span {
  position: absolute;
  left: 10px;
  top: 15px;
  color: grey;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .input:placeholder-shown + span {
  top: 15px;
  font-size: 0.9em;
}

.form label .input:focus + span,.form label .input:valid + span {
  top: 0px;
  font-size: 0.7em;
  font-weight: 600;
}

.form label .input:valid + span {
  color: green;
}

.submit {
  border: none;
  outline: none;
  background-color: royalblue;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
}

.submit:hover {
  background-color: rgb(56, 90, 194);
  cursor: pointer;
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}
</style>
<body>
   <div class="container">
   <form id="registerForm" class="form">
    <p class="title">Register </p>
    <p class="message">Signup now and get full access to our app. </p>
    <div class="flex">
        <label>
            <input id="firstname" class="input" type="text" placeholder="" required="">
            <span>Firstname</span>
        </label>

        <label>
            <input id="lastname" class="input" type="text" placeholder="" required="">
            <span>Lastname</span>
        </label>
    </div>  
    
    <label>
        <input id="email" class="input" type="email" placeholder="" required="">
        <span>Email</span>
    </label> 

    <label>
        <input id="password" class="input" type="password" placeholder="" required="">
        <span>Password</span>
    </label>
    
    <label>
        <input id="confirmPassword" class="input" type="password" placeholder="" required="">
        <span>Confirm password</span>
    </label>
    
    <button type="submit" class="submit">Submit</button>
    <p class="signin">Already have an account? <a href="#">Signin</a> </p>
</form>

</div>
<script>
document.getElementById("registerForm").addEventListener("submit", async function(event) {
    event.preventDefault();
    const firstname = document.getElementById("firstname").value;
    const lastname = document.getElementById("lastname").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    // Assign role (e.g., 2 for 'customer')
    const role = 2; // You can change this value if needed

    const requestData = {
        firstname,
        lastname,
        email,
        password,
        password_confirmation: confirmPassword,
        role, // Include the role in the request payload
    };

    try {
        const registerResponse = await fetch('http://localhost:8000/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData) // Send the requestData object
        });

        const registerData = await registerResponse.json();

        if (!registerResponse.ok) {
            alert(registerData.message || "Registration failed");
            return;
        }

        // Auto-login (optional part)
        const loginResponse = await fetch('http://localhost:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        const loginData = await loginResponse.json();

        if (loginResponse.ok) {
            localStorage.setItem('token', loginData.token);
            window.location.href = "dashboard.php";
        } else {
            alert(loginData.message || "Login failed after registration");
        }
    } catch (error) {
        console.error('Error:', error);
        alert("An error occurred. Please try again later.");
    }
});
</script>
</body>
</html>