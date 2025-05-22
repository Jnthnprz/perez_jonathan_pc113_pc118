<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Account Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h2 {
      color: #333;
    }
    p {
      font-size: 16px;
      color: #555;
    }
    .info {
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 6px;
      margin-top: 20px;
      border: 1px solid #ddd;
    }
    .info p {
      margin: 5px 0;
    }
    .footer {
      margin-top: 30px;
      font-size: 14px;
      color: #888;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome to Our Pet Store Management!</h2>
    <p>Hello <strong>{{$name}}</strong>,</p>
    <p>Your account has been created. Click me Daddy</p>
    <div style="display: flex; justify-content: center;">
    <a href="http://localhost/set-up.php?id={{$id}}"
       style="padding: 10px 20px; background-color: #0292B7; color:rgb(255, 253, 253); text-decoration: none; border-radius: 5px;">
       Complete Your Account
    </a>
    </div>


    <div class="footer">
      &copy; 2025 Kang Majojo kini. Be part of our community!
    </div>
  </div>
</body>
</html>

