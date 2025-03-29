<?php include("header.php"); ?>

<div class="main-container">
  <!-- Features Sidebar -->
  <aside class="features-sidebar">
    <h2>Features</h2>
    <ul>
      <li><a href="features/Search_Protein/search_analyze.php">Search Proteins</a></li>
      <li><a href="features/Sequence_alignment/align.php">Sequence Alignment</a></li>
      <li><a href="features/Motif_scan/motif.php">Motif Scan (PROSITE)</a></li>
      <li><a href="blast.php">BLAST Search</a></li>
      <li><a href="tree.php">Phylogenetic Tree</a></li>
      <li><a href="structure.php">3D Structure Lookup</a></li>
      <li><a href="domain.php">Domain Architecture</a></li>
      <li><a href="go.php">Gene Ontology (GO) Annotation</a></li>
      <li><a href="residue.php">Conserved Residue Map</a></li>
      <li><a href="hydrophobicity.php">Hydrophobicity / Charge Plot</a></li>
      <li><a href="disorder.php">Disorder Prediction</a></li>
      <li><a href="localization.php">Subcellular Localization</a></li>
      <li><a href="interaction.php">Protein-Protein Interaction</a></li>
      <li><a href="druggability.php">Druggability Assessment</a></li>
      <li><a href="filter.php">Custom Sequence Filtering</a></li>
    </ul>
  </aside>

<!-- Main Content -->
  <div class="content-right">
    <h1>Welcome to Protein Aligner</h1>

    <p>
      This interactive web tool is designed to help you analyze protein sequences across species in a biologically meaningful way.
    </p>

    <ul>
      <li>🔬 Start by searching for a protein family and taxonomic group to retrieve sequences from public databases.</li>
      <li>🧬 Perform multiple sequence alignments, analyze conservation, and identify known motifs/domains using tools like Clustal Omega and PROSITE.</li>
      <li>📊 Visualize key properties like domain architecture, hydrophobicity, and conserved regions.</li>
    </ul>

    <p>You can also explore additional features (coming soon!) such as:</p>

    <ul>
      <li>🚀 BLAST search</li>
      <li>🧱 3D structure lookup</li>
      <li>🧠 GO annotation</li>
      <li>💊 Druggability predictions and more</li>
    </ul>

    <p>
      Use the <strong>“Example”</strong> page to try out a pre-loaded dataset, or revisit previous jobs via the <strong>“Revisit”</strong> tab.
    </p>

    <p>
      No coding required — just input, submit, and explore your results.
    </p>
  </div>
</div>
<?php include("footer.php"); ?>

