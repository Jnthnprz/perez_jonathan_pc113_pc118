
<?php
// Start of file
$user = null; // Prevent "undefined variable" warning

$host = '127.0.0.1';
$db   = 'api';
$user_db = 'root';
$pass_db = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
  $pdo = new PDO($dsn, $user_db, $pass_db, $options);
} catch (PDOException $e) {
  die("DB connection failed: " . $e->getMessage());
}

$id = $_GET['id'] ?? null;

if ($id) {
  $stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
  $stmt->execute([$id]);
  $user = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Complete Account</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f3;
      padding: 50px;
    }
    .form-container {
      background-color: #fff;
      padding: 30px;
      max-width: 500px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[readonly] {
      background-color: #f5f5f5;
    }
    button {
      background-color: #0292B7;
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #02749a;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Complete Your Account</h2>
    <?php if ($user): ?>
      <form action="submit-setup.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <label>Full Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" readonly>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>

        <label>New Password</label>
        <input type="password" name="password" required>

        <button type="submit">Save Changes</button>
      </form>
    <?php else: ?>
      <p>User not found or invalid link.</p>
    <?php endif; ?>
  </div>
</body>
</html>
