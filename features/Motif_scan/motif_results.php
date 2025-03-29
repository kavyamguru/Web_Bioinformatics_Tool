<?php
session_start();
include("db_connect.php");

// Get job ID
$job_id = $_GET['job_id'] ?? ($_SESSION['last_job']['id'] ?? null);
if (!$job_id) die("❌ No job ID provided.");

// Fetch job info from DB
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();
if (!$job) die("❌ No job found.");

// Get file paths
$fasta_path = $job['fasta_path'];
$fasta_data = file_exists($fasta_path) ? file_get_contents($fasta_path) : ">No_Sequences_Found";
$motif_path = $job['motif_path'] ?? str_replace('.fasta', '.motifs', $fasta_path);
$motif_data = file_exists($motif_path) ? file_get_contents($motif_path) : "⚠️ Motif file not found.";

preg_match('/# HitCount:\s*(\d+)/', $motif_data, $matches);
$hit_count = isset($matches[1]) ? (int)$matches[1] : 0;

// Extract actual sequence name from motif file (first sequence only)
preg_match('/# Sequence:\s+(.+?)\s+from:/', $motif_data, $seq_match);
$sequence_name = $seq_match[1] ?? "Unknown";

preg_match('/# HitCount:\s*(\d+)/', $motif_data, $matches);
$hit_count = isset($matches[1]) ? (int)$matches[1] : 0;

// Count number of sequences
$num_sequences = substr_count($fasta_data, '>');

// Define URLs
$download_url = "https://bioinfmsc8.bio.ed.ac.uk/~s2754638/website/features/Motif_scan/data/uploads/{$job_id}.fasta";
$motif_url = "https://bioinfmsc8.bio.ed.ac.uk/~s2754638/website/features/Motif_scan/data/uploads/{$job_id}.motifs";
?>

<?php include("header.php"); ?>

<div class="result-details">
  <h2>🔬 Results for Job ID: <?= htmlspecialchars($job_id) ?></h2>
  <p><strong>Protein:</strong> <?= htmlspecialchars($job['protein_keyword']) ?></p>
  <p><strong>Taxon:</strong> <?= htmlspecialchars($job['taxon']) ?></p>
  <p><strong>Total Sequences Retrieved:</strong> <?= $num_sequences ?></p>
</div>

<div class="fasta-section">
  <div class="fasta-header">
    <h3>📄 FASTA File:</h3>
    <a href="<?= htmlspecialchars($download_url) ?>" download = "<?= $job_id ?>.fasta" class="download-btn">⬇️ Download FASTA</a>
  </div>
</div>
<div class="motif-result">
    <strong>Sequence:</strong> <?= htmlspecialchars($sequence_name) ?> <br>
    <strong>Hit Count:</strong> <?= $hit_count ?> <br>
    <strong>Full Scan:</strong> Yes <br>
    <strong>Data Source:</strong> PROSITE Database <br>
</div>

<?php if ($hit_count == 0): ?>
    <div class="no-hits">⚠️ No motifs found in this sequence.</div>
<?php endif; ?>

<div class="alignment-plot-container">
  <div class="motif-box">
    <div class="box-header sticky-header">
      <h3>🧬 Motif Scan</h3>

      <a href="<?= htmlspecialchars($motif_url) ?>" download = "<?= $job_id ?>.tsv" class="download-btn">⬇️ Download TSV</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download = "<?= $job_id ?>.json" class="download-btn">⬇️ Download JSON</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download = "<?= $job_id ?>.xml" class="download-btn">⬇️ Download XML</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download = "<?= $job_id ?>.bed" class="download-btn">⬇️ Download BED</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download = "<?= $job_id ?>.txt" class="download-btn">⬇️ Download TXT</a>
      
    </div>
    <pre><?= htmlspecialchars($motif_data) ?></pre>
  </div>
</div>

<?php include("footer.php"); ?>

