<?php include("header.php"); ?>

<div class="main-container">
  <div class="content-right">
    <h1>🧬 Help & User Guide</h1>
    <p>Welcome! This page explains how to use each part of the Protein Aligner web application. No coding required — just follow the prompts and enjoy your biological insights!</p>

    <div class="section">
      <h2>🔍 Search Proteins</h2>
      <p>Use this to fetch protein sequences based on a keyword (e.g. <strong>glucose-6-phosphatase</strong>) and a taxonomic group (e.g. <strong>Aves</strong> for birds).</p>
      <ul>
        <li>Sequences are retrieved from the NCBI protein database.</li>
        <li>Results are displayed in FASTA format and downloadable.</li>
      </ul>
    </div>

    <div class="section">
      <h2>🧬 Sequence Alignment</h2>
      <p>Paste or upload protein sequences in FASTA format to perform a multiple sequence alignment using <strong>Clustal Omega</strong>.</p>
      <ul>
        <li>Aligned sequences are displayed and downloadable.</li>
        <li>A conservation plot shows which regions are most conserved across sequences.</li>
      </ul>
    </div>

    <div class="section">
      <h2>🎯 Motif Scan (PROSITE)</h2>
      <p>This tool scans your protein sequences for known biological motifs or domains using <strong>PROSITE</strong> via the <code>patmatmotifs</code> tool.</p>
      <ul>
        <li>Identifies functionally important regions like active sites, glycosylation motifs, and phosphorylation sites.</li>
        <li>Provides hit counts and downloadable results.</li>
      </ul>
    </div>
    <div class="section">
  <h2>🧠 3D Structure Lookup</h2>
  <p>View predicted or experimental 3D protein structures using <strong>AlphaFold</strong> or <strong>RCSB PDB</strong>.</p>
  <ul>
    <li>You can enter a known <strong>UniProt ID</strong> (e.g. <code>P35575</code>) directly to view its structure.</li>
    <li>Or, enter a <strong>protein name</strong> and <strong>Scientific name</strong> — the system will automatically map it to a UniProt ID using NCBI and UniProt APIs.</li>
    <li>AlphaFold links will open predicted structures; RCSB will embed an interactive 3D viewer if available.</li>
    <li>If no structure is found, a friendly message will let you know.</li>
  </ul>
</div>

    <div class="section">
      <h2>📂 Revisit a Job</h2>
      <p>If you’ve run an analysis before, enter your Job ID here to retrieve the results without repeating the process.</p>
      <ul>
        <li>Fast access to FASTA, alignment, or motif data from previous runs.</li>
      </ul>
    </div>

    <div class="section">
      <h2>📊 Example Dataset</h2>
      <p>Not sure where to start? The Example page uses a pre-processed dataset (e.g. glucose-6-phosphatase in birds) so you can try all features instantly.</p>
    </div>

    <div class="section">
      <h2>🧠 Biological Insights</h2>
      <p>This tool is designed to help you:</p>
      <ul>
        <li>Compare sequences across species</li>
        <li>Identify conserved functional regions</li>
        <li>Detect domains that affect protein activity, stability, or localization</li>
      </ul>
    </div>

    <div class="section">
      <h2>❓ Need More Help?</h2>
      <p>Check the <strong>About</strong> and <strong>Credits</strong> pages for more context. If something's unclear, reach out to your course instructor or TA.</p>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>

