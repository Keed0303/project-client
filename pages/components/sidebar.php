<?php
$base = "http://" . $_SERVER['HTTP_HOST'] . "/project-client/pages";
?>

<div class="col-12 col-md-2 sidebar d-flex flex-column justify-content-between p-3 min-vh-100" id="sidebar">
  <div>
    <div class="logo mb-3">TechCare - CS</div>
    <a href="<?= $base ?>/dashboard.php" class="dashboard-link mb-1" onclick="setActive(this)">
      <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="<?= $base ?>/user/index.php" class="users-link mb-1" onclick="setActive(this)">
      <i class="bi bi-people"></i> Users
    </a>
  </div>

  <!-- Logout link at the bottom -->
  <a href="<?= $base ?>/components/logout.php" class="mt-auto text-white" onclick="setActive(this)">
    <i class="bi bi-box-arrow-right"></i> Logout
  </a>
</div>