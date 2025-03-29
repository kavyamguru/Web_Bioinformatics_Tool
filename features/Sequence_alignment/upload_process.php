<?php
session_start();
include("db_connect.php");

$protein = "FASTA Upload";
$taxon = "N/A";
$job_id = uniqid("job_");

// Save FASTA content
$fasta_content = "";
if (!empty($_POST['fasta_input'])) {
    $fasta_content = $_POST['fasta_input'];
} elseif (!empty($_FILES['fasta_file']['tmp_name'])) {
    $fasta_content = file_get_contents($_FILES['fasta_file']['tmp_name']);
} else {
    die("No input provided.");
}

$fasta_path = "data/uploads/{$job_id}.fasta";
file_put_contents($fasta_path, $fasta_content);

// Output file paths
$alignment_path = str_replace('.fasta', '.aln', $fasta_path);
$plot_path = str_replace('.fasta', '_conservation.png', $fasta_path);

// Run shell scripts
$alignment_cmd = escapeshellcmd(__DIR__ . "/clu_alignment.sh \"$fasta_path\" \"$alignment_path\"");
$plotcon_cmd = escapeshellcmd(__DIR__ . "/run_plotcon.sh \"$alignment_path\" \"$plot_path\"");

$output1 = shell_exec($alignment_cmd);
$output2 = shell_exec($plotcon_cmd);

// Log outputs
file_put_contents(__DIR__ . "/data/uploads/{$job_id}_debug.txt",
    "CMD 1:\n$alignment_cmd\n\nOUTPUT 1:\n$output1\n\nCMD 2:\n$plotcon_cmd\n\nOUTPUT 2:\n$output2"
);

// Save job info
$stmt = $pdo->prepare("INSERT INTO jobs (job_id, protein_keyword, taxon, fasta_path, alignment_path, conservation_plot) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$job_id, $protein, $taxon, $fasta_path, $alignment_path, $plot_path]);

// Redirect
$_SESSION['last_job']['id'] = $job_id;
header("Location: upload_results.php?job_id=$job_id");
exit;
?>
