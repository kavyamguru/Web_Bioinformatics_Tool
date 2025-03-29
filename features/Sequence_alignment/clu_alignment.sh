!/bin/bash    
input_fasta="$1" 
output_aln="$2" 

# Run clustalo for alignment 
clustalo -i "$input_fasta" -o "$output_aln" --outfmt=clu 
