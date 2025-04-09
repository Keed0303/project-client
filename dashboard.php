<?php include('./layouts/header.php') ?>
  <div class="overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->

      <?php include('./pages/components/sidebar.php') ?>

      <!-- Main Content -->
      <div class="col p-4" id="mainContent">
        <button class="btn btn-outline-primary d-md-none mb-3" onclick="toggleSidebar()">
          <i class="bi bi-list"></i>
        </button>
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
          <h3>Dashboard</h3>
          <div class="d-flex flex-wrap gap-2">
            <input type="date" class="form-control">
            <select class="form-select">
              <option>All Accounts</option>
            </select>
            <select class="form-select">
              <option>All Store/Branch</option>
            </select>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-4">
            <div class="card p-3">
              <h6>Total Sales Today</h6>
              <h5>PHP 600.00</h5>
              <small>Cash: PHP 600.00</small>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3">
              <h6>Top Product Sales Today</h6>
              <h5 class="text-primary">6 Sold</h5>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h6>Customer Today</h6>
              <h5 class="text-primary">1 Customers</h5>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card p-3">
              <h6>Peak Time Sales</h6>
              <div class="chart-placeholder mt-2"></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3">
              <h6>Top Flavors</h6>
              <ul class="list-unstyled small">
                <li class="text-primary">Very Hazelnut</li>
                <li class="text-primary">Mango</li>
                <li class="text-primary">Salted Caramel Vanilla</li>
                <li class="text-primary">Mint & Chocolate</li>
              </ul>
              <div class="ring-chart mx-auto">33%</div>
            </div>
          </div>

          <div class="col-12">
            <div class="card p-3">
              <h6>Daily Sales Performance</h6>
              <p>Apr 09, 2025 Wednesday</p>
              <p class="text-end">MTD Sales April 2025</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include('./layouts/footer.php') ?>