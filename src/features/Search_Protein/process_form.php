<?php
session_start();
require_once('db_connect.php');

$protein = trim($_POST['protein']);
$taxon = trim($_POST['taxon']);
$job_id = uniqid("job_");

// ✅ NEW: Get additional filter inputs from the form
$min_len = $_POST['min_len'] ?? 0;
$max_len = $_POST['max_len'] ?? 5000;
$retmax  = $_POST['retmax'] ?? 100;

// Output paths
$output_fasta = realpath(__DIR__ . "/data/uploads") . "/$job_id.fasta";
$script_path = realpath(__DIR__ . "/fetch_sequences.py");

// ✅ Use the full command with all filter arguments
$command = escapeshellcmd("/usr/bin/python3 $script_path \"$protein\" \"$taxon\" \"$output_fasta\" \"$min_len\" \"$max_len\" \"$retmax\"");
$output = shell_exec($command);

// Debug log
file_put_contents(__DIR__ . "/data/uploads/{$job_id}_debug.txt", "Command:\n$command\n\nOutput:\n$output\n");

// ✅ Add source field
$source = "search_protein";

// Save job to DB
$user_id = $_SESSION['user']['id'] ?? null;
$stmt = $pdo->prepare("INSERT INTO jobs (job_id, protein_keyword, taxon, fasta_path, user_id, source) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$job_id, $protein, $taxon, $output_fasta, $user_id, $source]);

// Redirect to results page
$_SESSION['last_job']['id'] = $job_id;
header("Location: results.php?job_id=$job_id");
exit;
?>

