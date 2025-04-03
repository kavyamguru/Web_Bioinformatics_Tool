<?php include("header.php"); ?>

<div class="main-container layout-flex">
  <!-- Features Sidebar -->
  <aside class="features-sidebar">
    <h2>Features</h2>
    <ul>
      <li><a href="features/Search_Protein/search_analyze.php">Search Proteins</a></li>
      <li><a href="features/Sequence_alignment/align.php">Sequence Alignment</a></li>
      <li><a href="features/Motif_scan/motif.php">Motif Scan (PROSITE)</a></li>
      <li><a href="features/3D_structure/structure.php">3D Structure Lookup</a></li>
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

    <p>You can also explore additional features such as:</p>

    <ul>
    <li>🧱 <strong>3D Structure Lookup</strong> — <em>Available now!</em></li>
  <li>🚀 BLAST Search — <em>Coming Soon</em></li>
  <li>🧠 Phylogenetic Tree Viewer — <em>Coming Soon</em></li>
  <li>📈 Domain Conservation Heatmap — <em>Coming Soon</em></li>
  <li>📊 Multiple Sequence Comparison Dashboard — <em>Coming Soon</em></li>
  <li>🔍 Functional Enrichment Analysis (GO/KEGG) — <em>Coming Soon</em></li>
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

