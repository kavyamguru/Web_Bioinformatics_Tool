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
$alignment_path = $job['alignment_path'] ?? str_replace('.fasta', '.aln', $fasta_path);
$alignment_data = file_exists($alignment_path) ? file_get_contents($alignment_path) : "⚠️ Alignment not found.";
$plot_filename = $job['conservation_plot'] ?? "data/uploads/{$job_id}_conservation.png";

// Fallback: check if plotcon added .1.png
if (!file_exists($plot_filename)) {
    $alt_plot = "data/uploads/{$job_id}_conservation.1.png";
    if (file_exists($alt_plot)) {
        $plot_filename = $alt_plot;
    }
}

// Count number of sequences
$num_sequences = substr_count($fasta_data, '>');

// Define download URL
$download_url = "https://bioinfmsc8.bio.ed.ac.uk/~s2754638/website/features/Sequence_alignment/data/uploads/{$job_id}.fasta";


$alignment_url = "https://bioinfmsc8.bio.ed.ac.uk/~s2754638/website/features/Sequence_alignment/data/uploads/{$job_id}.aln";
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
    <a href="<?= $download_url ?>" download = "<?= $job_id ?>.fasta"class="download-btn">⬇️ Download FASTA</a>
  </div>
</div>

<div class="alignment-plot-container">

<div class="alignment-box">
  <div class="box-header sticky-header">
    <h3>🧬 Aligned Sequences</h3>
    <a href="<?= htmlspecialchars($alignment_url) ?>" download = "<?= $job_id ?>.aln" class="download-btn">⬇️ Download Alignment</a>
  </div>
  <pre><?= htmlspecialchars($alignment_data) ?></pre>
</div>

  <!-- 📊 Conservation Plot -->
  <div class="plot-box">
    <div class="box-header">
      <h3>📊 Conservation Plot</h3>
      <?php if (file_exists($plot_filename)): ?>
        <a href="<?= htmlspecialchars($plot_filename) ?>" download class="download-btn">⬇️ Download Plot</a>
      <?php endif; ?>
    </div>
    <?php if (file_exists($plot_filename)): ?>
      <img src="<?= htmlspecialchars($plot_filename) ?>" alt="Conservation Plot" class="conservation-img">
    <?php else: ?>
      <p>⚠️ Conservation plot not found.</p>
    <?php endif; ?>
  </div>

</div>

<?php include("footer.php"); ?>
