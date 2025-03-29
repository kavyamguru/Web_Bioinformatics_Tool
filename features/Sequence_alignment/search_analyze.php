<?php include("header.php"); ?>

<div class="main-container">
  <div class="centered-form">
    <h1>🔬 Analyze a Protein</h1>
    <form method="POST" action="search_process.php">
      <label for="protein">Protein Keyword:</label>
      <input type="text" id="protein" name="protein" value="Glucose-6-phosphatase" required>

      <label for="taxon">Taxonomic Group:</label>
      <input type="text" id="taxon" name="taxon" value="Aves" required>

      <input type="submit" value="Submit">
    </form>
  </div>
</div>


<?php include("footer.php"); ?>

