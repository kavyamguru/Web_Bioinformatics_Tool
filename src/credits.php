<?php include("header.php"); ?>

<div class="main-container">
  <div class="content-right">
    <h1>🔖 Credits & Acknowledgements</h1>

    <div class="section">
      <h2>💻 Bioinformatics Tools & Resources</h2>
      <ul>
        <li><strong>NCBI E-utilities / EDirect</strong> – Used via BioPython's <code>Entrez</code> module to search and fetch protein sequences.  
          <a href="https://www.ncbi.nlm.nih.gov/books/NBK179288/" target="_blank">https://www.ncbi.nlm.nih.gov/books/NBK179288/</a>
        </li>
        <li><strong>Clustal Omega</strong> – Used to generate multiple sequence alignments.  
          <a href="https://www.ebi.ac.uk/Tools/msa/clustalo/" target="_blank">https://www.ebi.ac.uk/Tools/msa/clustalo/</a>
        </li>
        <li><strong>EMBOSS plotcon</strong> – Used to generate conservation plots from aligned sequences.  
          <a href="http://emboss.sourceforge.net/apps/release/6.6/emboss/apps/plotcon.html" target="_blank">http://emboss.sourceforge.net/apps/release/6.6/emboss/apps/plotcon.html</a>
        </li>
        <li><strong>EMBOSS patmatmotifs</strong> – Used to scan protein sequences for known PROSITE motifs.  
          <a href="http://emboss.sourceforge.net/apps/release/6.6/emboss/apps/patmatmotifs.html" target="_blank">http://emboss.sourceforge.net/apps/release/6.6/emboss/apps/patmatmotifs.html</a>
        </li>
        <li><strong>PROSITE Database</strong> – Used as the reference motif library in motif scans.  
          <a href="https://prosite.expasy.org/" target="_blank">https://prosite.expasy.org/</a>
        </li>
        <li><strong>AlphaFold Protein Structure Database</strong> – Used to display predicted protein 3D structures based on UniProt ID.
          <a href="https://alphafold.ebi.ac.uk/" target="_blank">https://alphafold.ebi.ac.uk/</a>
        </li>
        <li><strong>RCSB Protein Data Bank (PDB)</strong> – Embedded 3D structure viewer for known experimental models.
          <a href="https://www.rcsb.org/" target="_blank">https://www.rcsb.org/</a>
        </li>
        <li><strong>NCBI Entrez + UniProt Mapping</strong> – Used to fetch NCBI protein entries and convert to UniProt IDs for structural lookup.
        </li>

      </ul>
    </div>

    <div class="section">
      <h2>🧠 AI Tools Used</h2>
      <ul>
        <li><strong>ChatGPT (OpenAI)</strong>  
          <ul>
            <li>Helped generate boilerplate and functional PHP code (e.g. PDO usage, session handling).</li>
            <li>Helped create safe shell scripts for Clustal Omega, plotcon, and patmatmotifs execution.</li>
            <li>Suggested UI structure, layout logic, and styled content sections (CSS structure).</li>
            <li>Assisted in regex-based motif extraction and result display formatting.</li>
            <li>Provided help text, descriptions, button logic, and overall user interface copywriting.</li>
          </ul>
        </li>
      </ul>
      <p><em>All code and content generated with AI support was reviewed, debugged, and customized for this specific assessment.</em></p>
    </div>

    <div class="section">
      <h2>🧰 Programming Libraries & Resources</h2>
      <ul>
        <li><strong>BioPython</strong> – Used in <code>fetch_sequences.py</code> for accessing NCBI's Entrez API.  
          <a href="https://biopython.org/" target="_blank">https://biopython.org/</a>
        </li>
        <li><strong>PHP Manual</strong> – Referenced for writing PDO-based queries, form handling, and session logic.  
          <a href="https://www.php.net/manual/en/" target="_blank">https://www.php.net/manual/en/</a>
        </li>
        <li><strong>W3Schools</strong> & <strong>MDN Web Docs</strong> – Used for guidance on HTML forms, file inputs, JavaScript toggles, and CSS design.</li>
        <li><strong>file_get_contents()</strong> (PHP) – Used for API calls to NCBI and UniProt when mapping protein names to UniProt IDs.</li>
        <li><strong>Regex (PHP)</strong> – Used to extract UniProt IDs from XML/FASTA records for structure lookups.</li>
        <li><strong>HTML & iframe</strong> – Used to embed RCSB’s interactive 3D viewer directly in the results page.</li>

      </ul>
    </div>
    <div class="section">
  <h2>📚 Course Concepts Applied</h2>
  <p>The structure and functionality of this website were guided by key materials from the <strong>BILG11016: Introduction to Website and Database Design</strong> course. The following sessions were particularly influential in shaping this assessment:</p>
  <ul>
    <li><strong>Week 2 – HTML & First Steps with PHP:</strong> Form creation, basic input handling, and dynamic content rendering.</li>
    <li><strong>Week 3 – SQL & Query Setup:</strong> Used to build and query the MySQL database, with all SQL actions handled securely via PHP PDO.</li>
    <li><strong>Directed Learning #1:</strong> Helped solidify understanding of PHP-MySQL integration and input validation.</li>
    <li><strong>Week 5 – Website Architecture:</strong> Guided the folder and file structure (e.g. separating logic into feature directories).</li>
    <li><strong>Week 6 – Stylish Web Pages:</strong> Provided the foundation for consistent styling with custom CSS and clean layout design.</li>
    <li><strong>Week 7 – JSON/XML APIs:</strong> Enabled use of NCBI E-utilities and UniProt mapping APIs for external data fetching and structure lookup.</li>
  </ul>
  <p>These specific components were directly integrated into the website's development and execution for this assignment.</p>
</div>

    <div class="section">
      <h2>📦 Version Control</h2>
      <ul>
        <li>Project was versioned using <strong>Git</strong>, with regular local commits to track feature development and updates.</li>
      </ul>
    </div>

    <div class="section">
      <h2>👤 Author</h2>
      <p>This web application was designed and developed by a student as part of the assessment for the course  
        <strong>Introduction to Website and Database Design (BILG11016)</strong>, University of Edinburgh.
      </p>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>

