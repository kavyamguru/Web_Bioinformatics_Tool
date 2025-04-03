<?php
session_start();
include("db_connect.php");

$job_id = $_GET['job_id'] ?? ($_SESSION['last_job']['id'] ?? null);
if (!$job_id) die("❌ No job ID provided.");

$stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();
if (!$job) die("❌ No job found.");

$fasta_path = $job['fasta_path'];
$fasta_data = file_exists($fasta_path) ? file_get_contents($fasta_path) : ">No_Sequences_Found";
$alignment_path = $job['alignment_path'] ?? str_replace('.fasta', '.aln', $fasta_path);
$alignment_data = file_exists($alignment_path) ? file_get_contents($alignment_path) : "⚠️ Alignment not found.";
$plot_filename = $job['conservation_plot'] ?? "data/uploads/{$job_id}_conservation.png";

if (!file_exists($plot_filename)) {
    $alt_plot = "data/uploads/{$job_id}_conservation.1.png";
    if (file_exists($alt_plot)) {
        $plot_filename = $alt_plot;
    }
}

$num_sequences = substr_count($fasta_data, '>');

$download_url = "/~s2754638/website/features/Sequence_alignment/data/uploads/{$job_id}.fasta";
$alignment_url = "/~s2754638/website/features/Sequence_alignment/data/uploads/{$job_id}.aln";
?>

<?php include("header.php"); ?>

<div class="result-details">
  <h2>🔬 Results for Job ID: <?= htmlspecialchars($job_id) ?></h2>
  <p><strong>Protein:</strong> <?= htmlspecialchars($job['protein_keyword']) ?></p>
  <p><strong>Taxon:</strong> <?= htmlspecialchars($job['taxon']) ?></p>
  <p><strong>Total Sequences Retrieved:</strong> <?= $num_sequences ?></p>

  <?php if (isset($_SESSION['filters'])): ?>
    <div class="filter-info">
      <p><strong>Min Length:</strong> <?= htmlspecialchars($_SESSION['filters']['min_len']) ?></p>
      <p><strong>Max Length:</strong> <?= htmlspecialchars($_SESSION['filters']['max_len']) ?></p>
      <p><strong>Max Sequences:</strong> <?= htmlspecialchars($_SESSION['filters']['retmax']) ?></p>
      <p><strong>Exclude Ambiguous:</strong> <?= !empty($_SESSION['filters']['exclude_ambiguous']) ? "Yes" : "No" ?></p>
    </div>
  <?php endif; ?>
</div>

<!-- 📄 FASTA Download Box -->
<div class="fasta-box">
  <div class="box-header">
    <h3>📄 FASTA File</h3>
    <div class="dropdown-download">
      <button class="download-btn" onclick="toggleDropdown('fastaDropdown')">⬇️  Download FASTA </button>
      <div class="dropdown-content" id="fastaDropdown">
        <a href="<?= $download_url ?>" download="<?= $job_id ?>.fasta">FASTA (.fasta)</a>
        <a href="<?= $download_url ?>" download="<?= $job_id ?>.fa">FASTA (.fa)</a>
        <a href="<?= $download_url ?>" download="<?= $job_id ?>.txt">Text (.txt)</a>
      </div>
    </div>
  </div>
</div>


<!-- Layout: Aligned sequences + plot beside -->
<div class="alignment-plot-container">
  
  <!-- 🧬 Alignment Box -->
  <div class="alignment-box">
    <div class="box-header">
      <h3>🧬 Aligned Sequences</h3>
      <div class="dropdown-download">
        <button class="download-btn" onclick="toggleDropdown('alignDropdown')">⬇️  Download Alignment </button>
        <div class="dropdown-content" id="alignDropdown">
          <a href="<?= $alignment_url ?>" download="<?= $job_id ?>.aln">CLUSTAL (.aln)</a>
          <a href="<?= $download_url ?>" download="<?= $job_id ?>.fasta">FASTA (.fasta)</a>
        </div>
      </div>
    </div>
    <pre><?= htmlspecialchars($alignment_data) ?></pre>
  </div>

  <!-- 📊 Plot Box -->
  <div class="plot-box">
    <div class="box-header">
      <h3>📊 Conservation Plot</h3>
      <?php if (file_exists($plot_filename)): ?>
        <div class="dropdown-download">
          <button class="download-btn" onclick="toggleDropdown('plotDropdown')">⬇️  Download Plot</button>
          <div class="dropdown-content" id="plotDropdown">
            <a href="<?= $plot_filename ?>" download="<?= $job_id ?>_plot.png">PNG (.png)</a>
            <a href="<?= $plot_filename ?>" download="<?= $job_id ?>_plot.pdf">PDF (.pdf)</a>
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
  const dropdown = document.getElementById(id);
  dropdown.classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.download-btn')) {
    document.querySelectorAll(".dropdown-content").forEach(d => d.classList.remove("show"));
  }
}
</script>

<?php include("footer.php"); ?>

