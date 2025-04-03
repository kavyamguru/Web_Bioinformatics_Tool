<?php include("header.php"); ?>

<div class="main-container">
  <div class="content-right">
    <h1>About the Protein Aligner Project</h1>

    <p>
      The Protein Aligner web application was developed as part of the
      <strong>Introduction to Website and Database Design</strong> course assessment.
      It integrates multiple bioinformatics tools and data sources into an interactive platform
      that allows users to search, analyze, and visualize protein sequences across taxonomic groups.
    </p>

    <div class="section">
      <h2>🛠️ Technologies Used</h2>
      <ul>
        <li><strong>Frontend:</strong> HTML, CSS, minimal JavaScript</li>
        <li><strong>Backend:</strong> PHP (with PDO for database access)</li>
        <li><strong>Shell scripting:</strong> Bash used to execute command-line bioinformatics tools</li>
        <li><strong>Bioinformatics tools:</strong> Clustal Omega (for MSA), EMBOSS <code>patmatmotifs</code> (for motif detection), <code>plotcon</code> (for conservation plots)</li>
        <li><strong>Database:</strong> MySQL (for storing job info and results)</li>
	<li><strong>Version control:</strong> Git (used locally and optionally with GitHub)</li>
	<li><strong>External APIs:</strong> NCBI E-utilities and UniProt REST API used for retrieving RefSeq and UniProt IDs for structure visualization</li>
      </ul>
    </div>

    <div class="section">
      <h2>🧠 How It Works</h2>
      <p>
        The website allows a user to input a protein family name and a taxonomic group.
        It then fetches the corresponding protein sequences using NCBI’s EDirect tools or BioPython.
        Users can:
      </p>
      <ul>
        <li>Retrieve and view protein sequences in FASTA format</li>
        <li>Align sequences using Clustal Omega</li>
        <li>Generate conservation plots with plotcon</li>
	<li>Scan for known motifs/domains using PROSITE</li>
	<li>Users can visualize protein structures via AlphaFold or RCSB by entering a UniProt ID or using protein name + taxon, which is mapped automatically</li>
        <li>Download results in various formats</li>
      </ul>
    </div>

    <div class="section">
      <h2>🗃️ Job Management</h2>
      <p>
        Each analysis run is stored in a MySQL database with a unique Job ID.
        Users can revisit previous jobs or explore a pre-processed example dataset.
      </p>
    </div>

    <div class="section">
      <h2>🎯 Goal</h2>
      <p>
        The main goal of this project was to design a responsive and extensible web application
        that combines real biological analysis with accessible user interaction. All components
        are modular, allowing for easy extension in the future.
      </p>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>

