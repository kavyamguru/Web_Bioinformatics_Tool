<?php
session_start();
include("db_connect.php");

// Get job ID from GET or session
$job_id = $_GET['job_id'] ?? ($_SESSION['last_job']['id'] ?? null);
if (!$job_id) die("❌ No job ID provided.");

// Fetch job info from DB
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) die("❌ No job found.");

// Get FASTA content
$fasta_path = $job['fasta_path'];
$fasta_data = file_exists($fasta_path) ? file_get_contents($fasta_path) : ">No_Sequences_Found";

// Count number of sequences
$num_sequences = substr_count($fasta_data, '>');

// Define download URL
$download_url = "https://bioinfmsc8.bio.ed.ac.uk/~s2754638/website/features/Search_Protein/data/uploads/{$job_id}.fasta";
?>

<?php include("header.php"); ?>

<div class="result-details">
  <h2>🔬 Results for Job ID: <?= htmlspecialchars($job_id) ?></h2>
  <p><strong>Protein:</strong> <?= htmlspecialchars($job['protein_keyword']) ?></p>
  <p><strong>Taxon:</strong> <?= htmlspecialchars($job['taxon']) ?></p>
  <p><strong>Total Sequences Retrieved:</strong> <?= $num_sequences ?></p>
</div>

<?php
$fasta_entries = preg_split('/(?=>)/', $fasta_data, -1, PREG_SPLIT_NO_EMPTY);
?>

<div class="fasta-section">
  <div class="fasta-header">
    <h3>📄 Retrieved FASTA Sequences:</h3>
    <a href="<?= $download_url ?>" download class="download-btn">⬇️ Download FASTA</a>
  </div>

  <div class="fasta-box">
<?php foreach ($fasta_entries as $index => $entry): ?>
      <pre class="fasta-seq" <?= $index >= 10 ? 'style="display:none;"' : '' ?>>
        <?= htmlspecialchars($entry) ?>
      </pre>
    <?php endforeach; ?>
    <?php if (count($fasta_entries) > 10): ?>
      <button id="show-more-btn" onclick="showMoreSequences()">Show More</button>
    <?php endif; ?>
  </div>
</div>  
<script>
function showMoreSequences() {
  const hidden = document.querySelectorAll('.fasta-seq[style*="display:none"]');
  hidden.forEach(el => el.style.display = 'block');
  document.getElementById('show-more-btn').style.display = 'none';
}
</script>

<?php include("footer.php"); ?>

