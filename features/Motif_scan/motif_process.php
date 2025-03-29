<?php
session_start();
require_once('db_connect.php');

$protein = trim($_POST['protein']);
$taxon = trim($_POST['taxon']);
$job_id = uniqid("job_");

// Define paths
$upload_dir = realpath(__DIR__ . "/data/uploads");
$output_fasta = "$upload_dir/{$job_id}.fasta";
$script_path = realpath(__DIR__ . "/fetch_sequences.py");

// Run Python script to fetch sequences
$command = escapeshellcmd("/usr/bin/python3 $script_path \"$protein\" \"$taxon\" \"$output_fasta\"");
$output = shell_exec($command);

// ✅ Define `$motif_path` correctly
$motif_path = str_replace('.fasta', '.motifs', $output_fasta);

// Run motif detection script
$motif_cmd = escapeshellcmd(__DIR__ . "/run_motifs.sh \"$output_fasta\" \"$motif_path\"");
shell_exec($motif_cmd);

// Log for debugging
file_put_contents("$upload_dir/{$job_id}_debug.txt", "Command:\n$command\n\nOutput:\n$output\n");

// Save job details to database
$stmt = $pdo->prepare("INSERT INTO jobs (job_id, protein_keyword, taxon, fasta_path, motif_path) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$job_id, $protein, $taxon, $output_fasta, $motif_path]);

// Redirect to results page
$_SESSION['last_job']['id'] = $job_id;
header("Location: motif_results.php?job_id=$job_id");
exit;
?>

