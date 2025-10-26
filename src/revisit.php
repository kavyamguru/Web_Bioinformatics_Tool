<?php
session_start();
include(__DIR__ . "/db_connect.php");

// Check if Job ID is provided early
if (isset($_GET['job_id'])) {
    $job_id = trim($_GET['job_id']);

    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch();

    if ($job) {
        // Redirect based on result type
        if (!empty($job['motif_path'])) {
            header("Location: features/Motif_scan/motif_results.php?job_id=$job_id");
            exit;
        } elseif (!empty($job['alignment_path'])) {
            header("Location: features/Sequence_alignment/upload_results.php?job_id=$job_id");
            exit;
        } elseif (!empty($job['fasta_path'])) {
            header("Location: features/Search_Protein/results.php?job_id=$job_id");
            exit;
        } else {
            $error = "⚠️ No results found for this job.";
        }
    } else {
        $error = "❌ Invalid Job ID or job not found.";
    }
}
?>

<?php include("header.php"); ?>

<div class="main-container">
  <div class="centered-form">
    <h1>🔁 Revisit a Job</h1>
    <p>Enter your previously generated Job ID to view results.</p>
    
    <form method="GET" action="revisit.php">
      <label for="job_id">Job ID:</label>
      <input type="text" id="job_id" name="job_id" required>
      <input type="submit" value="Go">
    </form>

    <?php if (isset($error)): ?>
      <p style="color: red; text-align:center; margin-top:1rem;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </div>
</div>

<?php include("footer.php"); ?>

