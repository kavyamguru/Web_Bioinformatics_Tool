#!/bin/bash

input_fasta="$1"
output_file="$2"

# Check if patmatmotifs is installed
if ! command -v patmatmotifs &> /dev/null; then
  echo "❌ Error: patmatmotifs not found. Make sure EMBOSS is installed." >&2
  exit 1
fi

# Run patmatmotifs from EMBOSS
patmatmotifs -sequence "$input_fasta" -outfile "$output_file" -full -auto

# Check if patmatmotifs ran successfully
if [ $? -ne 0 ]; then
  echo "❌ Error: patmatmotifs failed to run." >&2
  exit 1
fi

echo "✅ Motif scan completed successfully. Results saved to $output_file."

