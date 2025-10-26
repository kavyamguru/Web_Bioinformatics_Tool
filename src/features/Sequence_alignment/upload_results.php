<?php
session_start();
include("db_connect.php");

$job_id = $_GET['job_id'] ?? ($_SESSION['last_job']['id'] ?? null);
if (!$job_id) die("❌ No job ID provided.");

// Fetch job info
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();
if (!$job) die("❌ No job found.");

// Paths
$fasta_path = $job['fasta_path'];
$alignment_path = $job['alignment_path'] ?? str_replace('.fasta', '.aln', $fasta_path);
$plot_filename = $job['conservation_plot'] ?? "data/uploads/{$job_id}_conservation.png";

// Check for fallback plot name
if (!file_exists($plot_filename)) {
  $alt_plot = "data/uploads/{$job_id}_conservation.1.png";
  if (file_exists($alt_plot)) {
    $plot_filename = $alt_plot;
  }
}

// Content
$fasta_data = file_exists($fasta_path) ? file_get_contents($fasta_path) : ">No_Sequences_Found";
$alignment_data = file_exists($alignment_path) ? file_get_contents($alignment_path) : "⚠️ Alignment not found.";
$num_sequences = substr_count($fasta_data, '>');

// Download URLs
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

<!-- 📄 FASTA Box -->
<div class="fasta-box">
  <div class="box-header">
    <h3>📄 FASTA File</h3>
    <div class="dropdown-download">
      <button class="download-btn" onclick="toggleDropdown('fastaDropdown')">⬇️  Download FASTA </button>
      <div class="dropdown-content" id="fastaDropdown">
        <a href="<?= $download_url ?>" download="<?= $job_id ?>.fasta">FASTA (.fasta)</a>
        <a href="<?= $download_url ?>" download="<?= $job_id ?>.txt">Text (.txt)</a>
      </div>
    </div>
  </div>
</div>

<!-- 🧬 Alignment & Plot Boxes -->
<div class="alignment-plot-container">

  <!-- 🧬 Aligned Sequences -->
  <div class="alignment-box">
    <div class="box-header sticky-header">
      <h3>🧬 Aligned Sequences</h3>
      <div class="dropdown-download">
	<button class="download-btn" onclick="toggleDropdown('alignmentDropdown')">⬇️  Download Alignment </button>
        <div class="dropdown-content" id="alignmentDropdown">
          <a href="<?= $alignment_url ?>" download="<?= $job_id ?>.aln">CLUSTAL (.aln)</a>
          <a href="<?= $download_url ?>" download="<?= $job_id ?>.fasta">FASTA (.fasta)</a>
        </div>
      </div>
    </div>
    <pre><?= htmlspecialchars($alignment_data) ?></pre>
  </div>

  <!-- 📊 Conservation Plot -->
  <div class="plot-box">
    <div class="box-header">
      <h3>📊 Conservation Plot</h3>
      <?php if (file_exists($plot_filename)): ?>
        <div class="dropdown-download">
          <button class="download-btn" onclick="toggleDropdown('plotDropdown')">⬇️  Download Plot </button>
          <div class="dropdown-content" id="plotDropdown">
            <a href="<?= $plot_filename ?>" download="<?= $job_id ?>_plot.png">PNG (.png)</a>
            <a href="<?= $plot_filename ?>" download="<?= $job_id ?>_plot.txt">Text (.txt)</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <?php if (file_exists($plot_filename)): ?>
      <img src="<?= $plot_filename ?>" alt="Conservation Plot" class="conservation-img">
    <?php else: ?>
      <p>⚠️ Conservation plot not found.</p>
    <?php endif; ?>
  </div>

</div>

<script>
function toggleDropdown(id) {
  const dropdowns = document.querySelectorAll('.dropdown-content');
  dropdowns.forEach(drop => {
    if (drop.id !== id) drop.style.display = 'none';
  });

  const target = document.getElementById(id);
  target.style.display = (target.style.display === 'block') ? 'none' : 'block';
}

window.onclick = function(event) {
  if (!event.target.matches('.download-btn')) {
    document.querySelectorAll('.dropdown-content').forEach(drop => {
      drop.style.display = "none";
    });
  }
}
</script>

<?php include("footer.php"); ?>

