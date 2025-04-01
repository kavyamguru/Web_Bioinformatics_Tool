<?php
session_start();
include("db_connect.php");

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];
  $confirm  = $_POST['confirm_password'];

  if ($password !== $confirm) {
    $error = "❌ Passwords do not match.";
  } elseif (strlen($password) < 6) {
    $error = "❌ Password must be at least 6 characters.";
  } else {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
      $error = "❌ Username already taken.";
    } else {
      $hashed = hash('sha256', $password);
      $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
      $stmt->execute([$username, $hashed]);
      $success = "✅ Registration successful. You can now <a href='login.php'>log in</a>.";
    }
  }
}
?>

<?php include("header.php"); ?>

<div class="main-container">
  <div class="centered-form">
    <h1>📝 Register</h1>
    <form method="POST">
      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <
      <label>Confirm Password:</label>
      <input type="password" name="confirm_password" required>

      <input type="submit" value="Register">
    </form>

    <?php if ($error): ?>
      <p style="color: red; margin-top: 1rem;"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
      <p style="color: green; margin-top: 1rem;"><?= $success ?></p>
    <?php endif; ?>
  </div>
</div>

<?php include("footer.php"); ?>

