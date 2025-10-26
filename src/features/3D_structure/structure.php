<?php include("header.php"); ?>
<div class="alignment-container">
  <h1>🧠 3D Structure Lookup</h1>
  <p>Select a method to retrieve the structure:</p>

  <!-- Tab Buttons -->
  <div class="tab-buttons">
    <button class="tab-btn active" onclick="showTab('uniprot')">Enter UniProt ID</button>
    <button class="tab-btn" onclick="showTab('protein')">Search by Protein + Taxon</button>
  </div>

  <!-- UniProt ID Form -->
  <div id="uniprot" class="tab-content active">
    <form method="GET" class="centered-form">
      <label for="uniprot_id">Enter UniProt ID:</label>
      <input type="text" name="uniprot_id" placeholder="e.g. P35575" required>
      <input type="submit" value="🔍 View Structure">
    </form>
  </div>

  <!-- Protein + Taxon Form -->
  <div id="protein" class="tab-content">
    <form method="GET" class="centered-form">
      <label for="protein">Protein name:</label>
      <input type="text" name="protein" placeholder="e.g. Glucose-6-phosphatase" required>

      <label for="taxon">Scientific name:</label>
      <input type="text" name="taxon" placeholder="e.g. Homo sapiens" required>

      <input type="submit" value="🔍 Search via UniProt">
    </form>
  </div>

<?php
// ✅ Option 1: Direct UniProt ID
if (isset($_GET['uniprot_id'])) {
    $uniprot_id = htmlspecialchars($_GET['uniprot_id']);
    echo "<h2>🔗 AlphaFold Prediction</h2>";
    echo "<a class='button-link' href='https://alphafold.ebi.ac.uk/entry/$uniprot_id' target='_blank'>View $uniprot_id on AlphaFold</a>";
    echo "<h2 style='margin-top:40px;'>🧬 RCSB PDB Viewer</h2>";
    echo "<iframe src='https://www.rcsb.org/3d-view/$uniprot_id' width='100%' height='500px' style='border: none;'></iframe>";
}

// ✅ Option 2: Protein + Taxon (uses UniProt search API)
elseif (isset($_GET['protein']) && isset($_GET['taxon'])) {
    $protein = urlencode($_GET['protein']);
    $taxon = urlencode($_GET['taxon']);

    // Step 1: Search UniProt
    $url = "https://rest.uniprot.org/uniprotkb/search?query=$protein+AND+organism_name:$taxon&format=json&size=1";

    $json = @file_get_contents($url);
    if (!$json) {
        echo "<p style='color:red;'>❌ Could not contact UniProt. Please try again later.</p>";
        exit;
    }

    $data = json_decode($json, true);
    $uniprot_id = $data['results'][0]['primaryAccession'] ?? null;

    if ($uniprot_id) {

require_once("db_connect.php"); // Make sure this is at the top of your file

$job_id = uniqid("job_");

// Prepare insert statement
$stmt = $pdo->prepare("INSERT INTO jobs
    (job_id, user_id, protein_keyword, taxon, uniprot_id, source)
    VALUES (?, ?, ?, ?, ?, ?)");

// Execute insert
$stmt->execute([
    $job_id,
    $_SESSION['user']['id'] ?? null,        // If not using login, leave as null
    $_GET['protein'] ?? null,
    $_GET['taxon'] ?? null,
    $uniprot_id,
    'structure'
]);

// Optional: Store job ID in session for "Revisit" feature
$_SESSION['last_job']['id'] = $job_id;

// Optional: show success message
        echo "<h2>🔗 AlphaFold Prediction</h2>";
        echo "<a class='button-link' href='https://alphafold.ebi.ac.uk/entry/$uniprot_id' target='_blank'>View $uniprot_id on AlphaFold</a>";
        echo "<h2 style='margin-top:40px;'>🧬 RCSB PDB Viewer</h2>";
        echo "<iframe src='https://www.rcsb.org/3d-view/$uniprot_id' width='100%' height='500px' style='border: none;'></iframe>";
    } else {
        echo "<p style='color:red;'>❌ No UniProt ID found for that protein/taxon combination.</p>";
    }
}
?>
</div>

<script>
function showTab(tabId, event) {
  document.querySelectorAll(".tab-content").forEach(div => div.classList.remove("active"));
  document.querySelectorAll(".tab-btn").forEach(btn => btn.classList.remove("active"));
  
  document.getElementById(tabId).classList.add("active");
  event.target.classList.add("active");
  }

</script>

<?php include("footer.php"); ?>

