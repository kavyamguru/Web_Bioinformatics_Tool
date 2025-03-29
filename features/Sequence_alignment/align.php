<?php include("header.php"); ?>
  
<div class="alignment-container">
  <h1>🧬 Sequence Alignment</h1>
  <p>Select how you want to provide sequences for alignment:</p>

  <!-- Tab Buttons -->
  <div class="tab-buttons">
    <a href="search_analyze.php" class="button-link">🔍 Search by Protein</a>"
  </div>

  <!-- Tab 1: FASTA Upload -->
  <div id="fasta-tab" class="tab-content active">
    <form method="POST" action="upload_process.php" enctype="multipart/form-data">
      <label for="fasta-input">Paste FASTA Sequences:</label>
      <textarea name="fasta_input" rows="10"></textarea>

      <label for="fasta-file">Or upload a FASTA file:</label>
      <input type="file" name="fasta_file" accept=".fasta,.fa">

      <input type="submit" value="Run Alignment">
    </form>
  </div>

  <!-- Tab 2: Search-based input -->
  <div id="search-tab" class="tab-content" style="display: none;">
    <form method="POST" action="search_analyze.php">
      <label for="protein">Protein Keyword:</label>
      <input type="text" name="protein" required>

      <label for="taxon">Taxonomic Group:</label>
      <input type="text" name="taxon" required>

      <input type="submit" value="Search and Align">
    </form>
  </div>
</div>

<script>
function showTab(tabId) {
  document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
  document.getElementById(tabId).classList.add('active');

  document.querySelectorAll('.tab-buttons button').forEach(btn => btn.classList.remove('active'));
  event.target.classList.add('active');
}
</script>

<?php include("footer.php"); ?>
