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
$motif_path = str_replace('.fasta', '.motifs', $fasta_path);

// Run shell scripts
$motif_cmd = escapeshellcmd(__DIR__ . "/run_motifs.sh \"$fasta_path\" \"$motif_path\"");
$output = shell_exec($motif_cmd);

// Log outputs
file_put_contents(__DIR__ . "/data/uploads/{$job_id}_debug.txt",
    "CMD 1:\n$motif_cmd\n\nOUTPUT 1:\n$output\n\nCMD 2:"
);

// Save job info
$stmt = $pdo->prepare("INSERT INTO jobs (job_id, protein_keyword, taxon, fasta_path, motif_path) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$job_id, $protein, $taxon, $fasta_path, $motif_path]);

// Redirect
$_SESSION['last_job']['id'] = $job_id;
header("Location: motif_results.php?job_id=$job_id");
exit;

?>
