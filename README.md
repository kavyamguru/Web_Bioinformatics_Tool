# Web_Bioinformatics_Tool  
MSc Bioinformatics | University of Edinburgh (2025)  
Course: Introduction to Website and Database Design (BILG11016)  
Student ID: B269797  

---

## 🔍 Purpose

This PHP/MySQL-based bioinformatics web application lets users:

1. Retrieve protein sequences for a chosen protein family and taxonomic group  
   (e.g. glucose-6-phosphatase in Aves)  
2. Perform alignment / conservation analysis using Clustal Omega or BLAST  
3. Scan sequences for motifs/domains via EMBOSS `patmatmotifs` and PROSITE  
4. Explore optional structure / annotation context  
5. View a pre-computed **example dataset** (glucose-6-phosphatase in Aves)  
6. Log in, save analyses and **revisit** previous results  

These map directly to the six “Overall Mission” points in the assignment brief.

---

## 🧠 Audience

**Biologists :** use an intuitive web interface to analyse protein conservation and motifs—no command line needed.  
**Developers / Markers :** can inspect modular PHP code, MySQL (PDO) usage and analysis logic in `src/features/`.

---

## 📂 Repository Structure

```text
Web_Bioinformatics_Tool/
├── src/
│   ├── index.php
│   ├── example.php
│   ├── help.php
│   ├── about.php
│   ├── credits.php
│   ├── login.php / register.php / logout.php
│   ├── user_dashboard.php / my_jobs.php / revisit.php
│   ├── css/
│   │   └── style.css
│   └── features/
│       ├── Search_Protein/
│       │   ├── search_analyze.php process_form.php results.php
│       │   ├── fetch_sequences.py
│       │   └── data/uploads/ → runtime FASTA + logs (README only)
│       ├── Sequence_alignment/
│       │   ├── clu_alignment.sh run_plotcon.sh + PHP scripts
│       ├── Motif_scan/
│       │   ├── run_motifs.sh motif_process.php motif_results.php
│       └── 3D_structure/ → structure.php
│
├── docs/
│   └── B269797_IWDD_Workplan.pdf
│
├── database/
│   ├── schema.sql   # DB schema
│   ├── example_dataset.sql
│   └── connection_config.php  # ignored (by .gitignore)
│
├── .gitignore
└── README.md

