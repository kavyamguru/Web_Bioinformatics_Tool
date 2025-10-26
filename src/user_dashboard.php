<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
include("header.php");
?>

<div class="main-container">
  <div class="content-right">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> 🎉</h1>
    <p>You are logged in. Add your protected content here.</p>
    <a href="logout.php">Logout</a>
  </div>
</div>

<?php include("footer.php"); ?>

