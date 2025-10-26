<?php include("header.php"); ?>

<div class="main-container">
  <div class="centered-form">
    <h1>🔬 Analyze a Protein</h1>
    <form method="POST" action="motif_process.php">
      <label for="protein">Protein Keyword:</label>
      <input type="text" id="protein" name="protein" value="Glucose-6-phosphatase" required>

      <label for="taxon">Taxonomic Group:</label>
      <input type="text" id="taxon" name="taxon" value="Aves" required>

      <!-- Optional filters -->
      <label for="min_len">Min Sequence Length:</label>
      <input type="number" name="min_len" value="100">

      <label for="max_len">Max Sequence Length:</label>
      <input type="number" name="max_len" value="1500">

      <label for="retmax">Max Sequences to Retrieve:</label>
      <input type="number" name="retmax" value="100">

      <label>
        <input type="checkbox" name="exclude_ambiguous" value="1">
        Exclude ambiguous sequences (X, B, Z)
      </label>

      <input type="submit" value="Submit">
    </form>
  </div>
</div>

<?php include("footer.php"); ?>

