<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BentaBox Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="./icon.png">

  <style>
    body {
      background-color: #f8fafc;
    }

    .sidebar {
      height: 100vh;
      background-color: #071437;
      color: white;
    }

    .sidebar .logo {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      display: flex;
      align-items: center;
      gap: 10px;
      border-left: 5px solid transparent;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background-color: #3e97ff;
      border-radius: 10px;

    }

    .card {
      border: none;
      border-radius: 0.75rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .card h5,
    .card h6 {
      color: #0d6efd;
    }

    .chart-placeholder {
      width: 100%;
      height: 200px;
      background: repeating-linear-gradient(-45deg,
          #e0e0e0,
          #e0e0e0 10px,
          #ffffff 10px,
          #ffffff 20px);
      border-radius: 0.75rem;
    }

    .ring-chart {
      width: 100px;
      height: 100px;
      background: conic-gradient(#0d6efd 33%, #e0e0e0 0);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #0d6efd;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -250px;
        top: 0;
        width: 250px;
        transition: left 0.3s;
        z-index: 1050;
      }

      .sidebar.show {
        left: 0;
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
      }

      .overlay.show {
        display: block;
      }
    }
  </style>
</head>

<body>

  <div class="overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->

      <?php include('../pages/components/sidebar.php') ?>

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

  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('show');
      document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    function setActive(element) {
      // Remove active class from all links
      document.querySelectorAll('.sidebar a').forEach(link => link.classList.remove('active'));
      // Add active class to the clicked link
      element.classList.add('active');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
