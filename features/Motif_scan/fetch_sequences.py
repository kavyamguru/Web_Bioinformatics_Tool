#!/usr/bin/env python3
import sys
from Bio import Entrez

# Get input
if len(sys.argv) < 4:
    sys.exit("Usage: fetch_sequences.py <protein> <taxon> <outfile>")

protein, taxon, outfile = sys.argv[1], sys.argv[2], sys.argv[3]
Entrez.email = "s2754638@ed.ac.uk"  # REQUIRED

query = f"{protein}[All fields] AND {taxon}[Organism]"

try:
    handle = Entrez.esearch(db="protein", term=query, retmax=100)
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
