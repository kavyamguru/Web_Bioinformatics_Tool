<?php
session_start();
require_once("db_connect.php");

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$jobs = $stmt->fetchAll();
?>

<?php include("header.php"); ?>

<div class="main-container">
  <h1>📂 My Jobs</h1>

  <?php if (count($jobs) > 0): ?>
    <div class="job-table-wrapper">
      <table class="job-table">
        <thead>
          <tr>
            <th>Job ID</th>
            <th>Protein</th>
            <th>Taxon</th>
            <th>Source</th>
            <th>Created</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($jobs as $job): ?>
            <?php
              // Decide the results page based on source
              $result_page = "features/Sequence_alignment/upload_results.php";
              if ($job['source'] === 'search') {
                $result_page = "features/Sequence_alignment/search_results.php";
              } elseif ($job['source'] === 'motif') {
                $result_page = "features/Motif_scan/motif_results.php";
              } elseif ($job['source'] === 'search_protein') {
                $result_page = "features/Search_Protein/results.php";
	      } elseif ($job['source'] === 'structure') {
                $result_page = "features/3D_structure/structure.php";
	      }
            ?>
            <tr>
              <td><?= htmlspecialchars($job['job_id']) ?></td>
              <td><?= htmlspecialchars($job['protein_keyword']) ?></td>
              <td><?= htmlspecialchars($job['taxon']) ?></td>
              <td><?= ucfirst($job['source']) ?></td>
              <td><?= htmlspecialchars($job['created_at']) ?></td>
	      <td>
                <a href="<?= $result_page ?>?job_id=<?= urlencode($job['job_id']) ?>" class="view-link">View</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p>You haven't submitted any jobs yet.</p>
  <?php endif; ?>
</div>

<?php include("footer.php"); ?>

