<?php include("header.php"); ?>

<div class="example-wrapper">
  <div class="example-header">
    <h1>🧪 Explore Example Jobs</h1>
    <p>
      New to Protein Aligner? This page walks you through real examples for each core feature of the website.
      You'll learn what each tool does, what input is expected, what filters are available, and what outputs you'll get.
    </p>
  </div>

  <!-- Getting Started Section -->
  <div class="example-card" style="border-left: 5px solid #3a7bd5;">
    <h2>🌐 Getting Started</h2>
    <p>The website allows you to analyze protein sequences from search to structure — all from a user-friendly interface.</p>
    <ul>
      <li><strong>Navigation Bar:</strong> Use the top menu to access <em>Search Proteins</em>, <em>Sequence Alignment</em>, <em>Motif Scan</em>, and more.</li>
      <li><strong>Features Sidebar:</strong> On the homepage, use the left sidebar to explore all 15+ tools.</li>
      <li><strong>Login/Register:</strong> Creating an account lets you save and revisit your jobs via the <em>My Jobs</em> tab.</li>
    </ul>
  </div>

  <div class="example-grid">

    <!-- 🔍 Search Proteins -->
    <div class="example-card">
      <h2>🔍 Search Proteins</h2>
      <p>
        This feature lets you fetch protein sequences from NCBI based on a keyword and taxonomic group.
      </p>
      <ul>
        <li><strong>Inputs:</strong> Protein keyword and taxon (e.g., Glucose-6-phosphatase, Aves)</li>
        <li><strong>Filters:</strong>
          <ul style="margin-left: 1rem;">
            <li><strong>Min Length / Max Length</strong> – Filters sequences by length</li>
            <li><strong>Max Sequences</strong> – Limit how many sequences are retrieved</li>
          </ul>
        </li>
        <li><strong>Outputs:</strong> Downloadable FASTA file (.fasta / .txt) containing all matching sequences</li>
      </ul>

      <div class="example-details">
        <p>📄 <strong>Example:</strong></p>
        <ul>
          <li><strong>Protein:</strong> Glucose-6-phosphatase</li>
          <li><strong>Taxon:</strong> Aves</li>
          <li><strong>Filters:</strong> Min = 100, Max = 1200, Max Sequences = 100</li>
        </ul>
      </div>

      <a class="example-btn" href="features/Search_Protein/results.php?job_id=job_67ebd2b2779c3">View Example</a>
    </div>

    <!-- 🔗 Sequence Alignment -->
    <div class="example-card">
      <h2>🔗 Sequence Alignment</h2>
      <p>This feature aligns multiple sequences using Clustal Omega and highlights conserved regions using Plotcon.</p>

      <!-- Search-Based -->
      <h4>🔬 Search-Based Alignment</h4>
      <ul>
        <li><strong>How:</strong> Enter protein and taxon → fetch sequences → align</li>
        <li><strong>Filters:</strong> Min = 100, Max = 1200, Max Sequences = 10</li>
        <li><strong>Outputs:</strong>
          <ul style="margin-left: 1rem;">
            <li><code>.aln</code> – Aligned sequence file</li>
            <li><code>.png</code> – Conservation plot showing conserved residues</li>
          </ul>
        </li>
      </ul>

      <div class="example-details">
        <p>📄 <strong>Example:</strong></p>
        <ul>
          <li><strong>Job ID:</strong> job_67eb9ef8099e7</li>
          <li><strong>Filters:</strong> Min = 100, Max = 1200, Max Sequences = 10</li>
        </ul>
      </div>

      <a class="example-btn" href="features/Sequence_alignment/search_results.php?job_id=job_67ebd33e07f22">View Example</a>

      <!-- Upload-Based -->
      <h4>📤 Upload-Based Alignment</h4>
      <ul>
        <li><strong>How:</strong> Paste/upload your own FASTA file → align</li>
        <li><strong>Filters:</strong> Min = 50, Max = 2000</li>
        <li><strong>Outputs:</strong>
          <ul style="margin-left: 1rem;">
            <li><code>.aln</code> – Aligned output file</li>
            <li><code>.png</code> – Conservation visualization</li>
          </ul>
        </li>
      </ul>

      <div class="example-details">
        <p>📄 <strong>Example:</strong></p>
        <ul>
          <li><strong>Job ID:</strong> job_67eb9f5711846</li>
          <li><strong>Filters:</strong> Min = 50, Max = 2000</li>
        </ul>
      </div>

      <a class="example-btn" href="features/Sequence_alignment/upload_results.php?job_id=job_67ebd384830b4">View Example</a>
    </div>

    <!-- 🧬 Motif Scan -->
    <div class="example-card">
      <h2>🧬 Motif Scan (PROSITE)</h2>
      <p>
        This tool scans protein sequences to identify known motifs/domains using the <strong>EMBOSS patmatmotifs</strong> tool.
        You can either retrieve sequences using a search or upload your own FASTA input.
      </p>

      <!-- Search-Based -->
      <h4>🔬 Search-Based Motif Scan</h4>
      <ul>
        <li><strong>Inputs:</strong> Protein name + Taxonomic group</li>
        <li><strong>Filters:</strong> Min = 100, Max = 1500, Max Sequences = 10</li>
        <li><strong>Outputs:</strong>
          <ul style="margin-left: 1rem;">
            <li><code>.motif.txt</code> – Text summary of identified motifs</li>
            <li><code>.png</code> – Motif position visualization</li>
          </ul>
        </li>
      </ul>

      <div class="example-details">
        <p>📄 <strong>Example:</strong></p>
        <ul>
          <li><strong>Job ID:</strong> job_67eb9f789a5a8</li>
          <li><strong>Protein:</strong> Glucose-6-phosphatase</li>
          <li><strong>Taxon:</strong> Aves</li>
          <li><strong>Filters:</strong> Min = 100, Max = 1500, Sequences = 10</li>
        </ul>
      </div>

      <a class="example-btn" href="features/Motif_scan/motif_results.php?job_id=job_67ebd3d4958c4">View Example</a>

      <!-- Upload-Based -->
      <h4>📤 Upload-Based Motif Scan</h4>
      <ul>
        <li><strong>Inputs:</strong> Upload FASTA file</li>
        <li><strong>Filters:</strong> Min = 100, Max = 1500</li>
        <li><strong>Outputs:</strong>
          <ul style="margin-left: 1rem;">
            <li><code>.motif.txt</code> with matched motifs</li>
            <li><code>.png</code> visualizing motif hits</li>
          </ul>
        </li>
      </ul>

      <div class="example-details">
        <p>📄 <strong>Example:</strong></p>
        <ul>
          <li><strong>Job ID:</strong> job_67eb9fcdd74d5</li>
          <li><strong>Filters:</strong> Min = 100, Max = 1500, Sequences = 10</li>
        </ul>
      </div>

      <a class="example-btn" href="features/Motif_scan/motif_results.php?job_id=job_67ebd4137f945">View Example</a>
    </div>

  </div>
</div>

<?php include("footer.php"); ?>

