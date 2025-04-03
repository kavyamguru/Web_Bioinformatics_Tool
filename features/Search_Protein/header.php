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
  <link rel="stylesheet" href="css/style.css?v=3">
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/phylotree@1.0.0/phylotree.min.js"></script>
</head>
<body>

<nav class="topnav">
  <ul class="nav-links">
    <li><a href="__DIR__ . /../../../index.php">Home</a></li>
    <li><a href="__DIR__ . /../../../example.php">Example</a></li>
    <li><a href="__DIR__ . /../../../revisit.php">Revisit</a></li>
    <li><a href="__DIR__ . /../../../help.php">Help</a></li>
    <li><a href="__DIR__ . /../../../about.php">About</a></li>
    <li><a href="__DIR__ . /../../../credits.php">Credits</a></li>
</ul>

  <div class="login-right">
<?php if (isset($_SESSION['username'])): ?>
  <span style="margin-right: 10px;">👋 <?= htmlspecialchars($_SESSION['username']) ?></span>
  <a href="__DIR__ . /../../logout.php" class="login-btn">Logout</a>
<?php else: ?>
  <a href="__DIR__ . /../../register.php" class="login-btn" style="margin-right: 10px;">Register</a>
  <a href="__DIR__ . /../../login.php" class="login-btn">Login</a>
<?php endif; ?>

</div>
</nav>

