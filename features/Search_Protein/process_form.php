<?php
session_start();
require_once('db_connect.php');

$protein = trim($_POST['protein']);
$taxon = trim($_POST['taxon']);
$job_id = uniqid("job_");

// Absolute path to output file
$output_fasta = realpath(__DIR__ . "/data/uploads") . "/$job_id.fasta";
$script_path = realpath(__DIR__ . "/fetch_sequences.py");

// Run Python script with 3 arguments
$command = escapeshellcmd("/usr/bin/python3 $script_path \"$protein\" \"$taxon\" \"$output_fasta\"");
$output = shell_exec($command);

// Log what happened (for debugging)
file_put_contents(__DIR__ . "/data/uploads/{$job_id}_debug.txt", "Command:\n$command\n\nOutput:\n$output\n");

// Save to DB
$stmt = $pdo->prepare("INSERT INTO jobs (job_id, protein_keyword, taxon, fasta_path) VALUES (?, ?, ?, ?)");
$stmt->execute([$job_id, $protein, $taxon, $output_fasta]);

// Redirect
$_SESSION['last_job']['id'] = $job_id;
header("Location: results.php?job_id=$job_id");
exit;
?>

