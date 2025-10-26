<?php
session_start();
require_once('db_connect.php');

$protein = trim($_POST['protein']);
$taxon   = trim($_POST['taxon']);
$job_id  = uniqid("job_");

// ✅ Filter parameters
$min_len = $_POST['min_len'] ?? 0;
$max_len = $_POST['max_len'] ?? 5000;
$retmax  = $_POST['retmax']  ?? 100;
$exclude_ambiguous = isset($_POST['exclude_ambiguous']);

// File paths
$upload_dir = realpath(__DIR__ . "/data/uploads");
$fasta_path = "$upload_dir/{$job_id}.fasta";
$alignment_path = str_replace('.fasta', '.aln', $fasta_path);
$plot_path = str_replace('.fasta', '_conservation.png', $fasta_path);

// Python script path
$script_path  = realpath(__DIR__ . "/fetch_sequences.py");

// ✅ Construct command
$command = escapeshellcmd("/usr/bin/python3 $script_path \"$protein\" \"$taxon\" \"$fasta_path\" \"$min_len\" \"$max_len\" \"$retmax\"");
$output = shell_exec($command);

// ✅ Remove ambiguous sequences (optional)
if ($exclude_ambiguous && file_exists($fasta_path)) {
    $fasta_content = file_get_contents($fasta_path);

    function filter_ambiguous($fasta) {
        $entries = preg_split('/(?=>)/', $fasta, -1, PREG_SPLIT_NO_EMPTY);
        $filtered = [];
        foreach ($entries as $entry) {
            $lines = explode("\n", trim($entry));
            $header = array_shift($lines);
            $sequence = strtoupper(implode('', $lines));
            if (preg_match('/[^ACDEFGHIKLMNPQRSTVWY]/', $sequence)) continue;
            $filtered[] = ">$header\n" . wordwrap($sequence, 60);
        }
        return implode("\n", $filtered);
    }

    $filtered_fasta = filter_ambiguous($fasta_content);
    file_put_contents($fasta_path, $filtered_fasta);
}

// ✅ Run alignment
$alignment_cmd = escapeshellcmd(__DIR__ . "/clu_alignment.sh \"$fasta_path\" \"$alignment_path\"");
shell_exec($alignment_cmd);

// ✅ Run conservation plot
$plotcon_cmd = escapeshellcmd(__DIR__ . "/run_plotcon.sh \"$alignment_path\" \"$plot_path\"");
shell_exec($plotcon_cmd);

// ✅ User & source
$user_id = $_SESSION['user']['id'] ?? null;
$source = "search";

// ✅ Save to DB
$stmt = $pdo->prepare("INSERT INTO jobs (job_id, protein_keyword, taxon, fasta_path, alignment_path, conservation_plot, user_id, source) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$job_id, $protein, $taxon, $fasta_path, $alignment_path, $plot_path, $user_id, $source]);

// ✅ Debug log
file_put_contents("$upload_dir/{$job_id}_debug.txt",
    "Fetch:\n$command\n\nAlignment:\n$alignment_cmd\n\nPlot:\n$plotcon_cmd\n\nOutput:\n$output"
);

// ✅ Redirect
$_SESSION['last_job']['id'] = $job_id;
header("Location: search_results.php?job_id=$job_id");
exit;
?>

