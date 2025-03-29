#!/bin/bash

alignment_file="$1"
output_image="$2"

# Remove .png extension if present
base_output="${output_image%.png}"

# Run plotcon and prevent .1.png suffix
plotcon -sequence "$alignment_file" -graph png -goutfile "$base_output" -winsize 4

