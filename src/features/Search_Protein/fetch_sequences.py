#!/usr/bin/env python3
import sys
from Bio import Entrez

# Check for required args
if len(sys.argv) < 7:
    sys.exit("Usage: fetch_sequences.py <protein> <taxon> <outfile> <min_len> <max_len> <retmax>")

# Parse args
protein, taxon, outfile, min_len, max_len, retmax = sys.argv[1:7]
min_len, max_len, retmax = int(min_len), int(max_len), int(retmax)

# Entrez config
Entrez.email = "s2754638@ed.ac.uk"
Entrez.api_key = "c65b31e5970bdfa388c52079674dd7ad1a08"

# Build query
query = f"{protein}[All Fields] AND {taxon}[Organism] AND {min_len}:{max_len}[Sequence Length]"

try:
    handle = Entrez.esearch(db="protein", term=query, retmax=retmax)
    ids = Entrez.read(handle)["IdList"]
    handle.close()

    if not ids:
        with open(outfile, "w") as f:
            f.write(">No_Sequences_Found\n")
        sys.exit(0)

    fetch = Entrez.efetch(db="protein", id=",".join(ids), rettype="fasta", retmode="text")
    data = fetch.read()
    fetch.close()

    with open(outfile, "w") as f:
        f.write(data)

    print(f"✅ Saved {len(ids)} sequences to {outfile}")

except Exception as e:
    with open(outfile, "w") as f:
        f.write(">Fetch_Error\n" + str(e))
    sys.exit(1)

