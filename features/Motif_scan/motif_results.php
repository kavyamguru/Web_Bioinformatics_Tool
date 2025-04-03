<?php
session_start();
include("db_connect.php");

// Get job ID
$job_id = $_GET['job_id'] ?? ($_SESSION['last_job']['id'] ?? null);
if (!$job_id) die("❌ No job ID provided.");

// Fetch job info
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();
if (!$job) die("❌ No job found.");

// Paths
$fasta_path = $job['fasta_path'];
$fasta_data = file_exists($fasta_path) ? file_get_contents($fasta_path) : ">No_Sequences_Found";

$motif_path = $job['motif_path'] ?? str_replace('.fasta', '.motifs', $fasta_path);
$motif_data = file_exists($motif_path) ? file_get_contents($motif_path) : "⚠️ Motif file not found.";

// Extract info
preg_match('/# Sequence:\s+(.+?)\s+from:/', $motif_data, $seq_match);
$sequence_name = $seq_match[1] ?? "Unknown";

preg_match('/# HitCount:\s*(\d+)/', $motif_data, $matches);
$hit_count = isset($matches[1]) ? (int)$matches[1] : 0;

// Count sequences
$num_sequences = substr_count($fasta_data, '>');

// URLs
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

<div class="fasta-header">
  <h3>📄 FASTA File:</h3>
  <div class="dropdown-download">
    <!-- Single button with dropdown for multiple formats -->
    <button class="download-btn" onclick="toggleDropdown('fastaDownload')">
      Download ▼
    </button>
    <div class="dropdown-content" id="fastaDownload">
      <!-- The same $download_url, but different extensions -->
      <a href="<?= htmlspecialchars($download_url) ?>" download="<?= $job_id ?>.fasta">
        FASTA (.fasta)
      </a>
      <a href="<?= htmlspecialchars($download_url) ?>" download="<?= $job_id ?>.txt">
        Text (.txt)
      </a>
    </div>
  </div>
</div>

<div class="motif-result">
  <strong>Sequence:</strong> <?= htmlspecialchars($sequence_name) ?><br>
  <strong>Hit Count:</strong> <?= $hit_count ?><br>
  <strong>Full Scan:</strong> Yes<br>
  <strong>Data Source:</strong> PROSITE Database<br>
</div>

<?php if ($hit_count === 0): ?>
  <div style="background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 12px; margin-top: 15px; border-radius: 6px;">
    ⚠️ <strong>No PROSITE motifs found in this sequence.</strong><br>
    This might occur when:
    <ul style="margin-top: 5px; padding-left: 20px;">
      <li>The protein lacks known conserved patterns.</li>
      <li>The sequence is partial or divergent from reference models.</li>
      <li>PROSITE currently has no matching entries for this sequence.</li>
    </ul>
    You can try again using a well-characterized protein like <em>cytochrome c</em> or <em>ATP synthase</em>.
  </div>
<?php endif; ?>

<div class="box-header sticky-header">
  <h3>🧬 Motif Scan</h3>
  <div class="dropdown-download">
    <button class="download-btn" onclick="toggleDropdown('motifDownload')">
      Download ▼
    </button>
    <div class="dropdown-content" id="motifDownload">
      <a href="<?= htmlspecialchars($motif_url) ?>" download="<?= $job_id ?>.tsv">TSV (.tsv)</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download="<?= $job_id ?>.json">JSON (.json)</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download="<?= $job_id ?>.xml">XML (.xml)</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download="<?= $job_id ?>.bed">BED (.bed)</a>
      <a href="<?= htmlspecialchars($motif_url) ?>" download="<?= $job_id ?>.txt">Text (.txt)</a>
    </div>
   </div>
  </div>
 <pre><?= htmlspecialchars($motif_data) ?></pre>
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

