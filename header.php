<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Protein Aligner</title>
  <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>

<nav class="topnav">
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="example.php">Example</a></li>
    <li><a href="revisit.php">Revisit</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="credits.php">Credits</a></li>
    
    <?php if (isset($_SESSION['user'])): ?>
      <li><a href="my_jobs.php">🔁 My Jobs</a></li>
    <?php endif; ?>
  </ul>

  <div class="login-right">
    <?php if (isset($_SESSION['user'])): ?>
      <span style="margin-right: 10px;">👋 <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
      <a href="logout.php" class="login-btn">Logout</a>
    <?php else: ?>
      <a href="register.php" class="login-btn" style="margin-right: 10px;">Register</a>
      <a href="login.php" class="login-btn">Login</a>
    <?php endif; ?>
  </div>
</nav>

