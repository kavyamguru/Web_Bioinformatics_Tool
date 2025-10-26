<?php
session_start();
include("db_connect.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  // Validate credentials
  if ($user && hash('sha256', $password) === $user['password_hash']) {
    $_SESSION['username'] = $username;

    // ✅ Store user object for later access
    $_SESSION['user'] = [
      'id' => $user['id'],
      'username' => $user['username']
    ];

    header("Location: index.php"); // Redirect to homepage or user_dashboard.php
    exit;
  } else {
    $error = "❌ Invalid username or password.";
  }
}
?>

<?php include("header.php"); ?>

<div class="main-container">
  <div class="centered-form">
    <h1>🔐 Login</h1>
    <form method="POST" action="">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>

      <input type="submit" value="Login">
    </form>

    <?php if (!empty($error)): ?>
      <p style="color: red; margin-top: 1rem;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <p style="margin-top: 1rem;">
      Don't have an account? <a href="register.php">Register here</a>.
    </p>
  </div>
</div>

<?php include("footer.php"); ?>

