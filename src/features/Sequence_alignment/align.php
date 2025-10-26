<?php include("header.php"); ?>

<div class="alignment-wrapper">
  <h1>🧬 Sequence Alignment</h1>
  <p>Select how you want to provide sequences for alignment:</p>

  <!-- Search by Protein Shortcut -->
  <div class="tab-buttons">
    <a href="search_analyze.php" class="button-link">🔍 Search by Protein</a>
  </div>

  <!-- FASTA Upload Form -->
  <form method="POST" action="upload_process.php" enctype="multipart/form-data">
    <label for="fasta_input">Paste FASTA Sequences:</label>
    <textarea name="fasta_input" rows="8" placeholder=">Sequence1
MSTNPKPQRKTKRNTNRRPQDVKFPGG..."></textarea>

    <label for="fasta_file">Or upload a FASTA file:</label>
    <input type="file" name="fasta_file" accept=".fasta,.fa,.txt">

    <label for="min_len">Min Sequence Length:</label>
    <input type="number" name="min_len" value="50" min="10" max="10000">

    <label for="max_len">Max Sequence Length:</label>
    <input type="number" name="max_len" value="2000" min="10" max="10000">

    <label>
      <input type="checkbox" name="exclude_ambiguous" value="1">
      Exclude ambiguous residues (X, -, etc.)
    </label>

    <input type="submit" value="Run Alignment">
  </form>
</div>

<?php include("footer.php"); ?>

