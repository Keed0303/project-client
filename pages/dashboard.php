<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ./login.php"); // Adjust path based on where your login page is
    exit();
}
?>

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
      background-color: #071437;
      color: white;
      width: 250px;
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

    .keen-table-card {
    border: none;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    border-radius: 1rem;
    overflow: hidden;
  }

  .keen-table-header {
    background-color: #f5f8fa;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #eff2f5;
  }

  .keen-table-header h5 {
    margin: 0;
    font-weight: 600;
    color: #181c32;
  }

  .keen-table th {
    color: #7e8299;
    font-weight: 600;
    background-color: #f9f9f9;
    font-size: 0.875rem;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #eff2f5;
  }

  .keen-table td {
    font-size: 0.925rem;
    padding: 1rem 1.25rem;
    vertical-align: middle;
    color: #3f4254;
    border-bottom: 1px solid #eff2f5;
  }

  .keen-table tbody tr:hover {
    background-color: #f1faff;
    transition: background 0.3s;
  }

  .keen-table-responsive {
    overflow-x: auto;
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
        </div>
          <div id="tableSection" class=" container-fluid p-4 bg-body-tertiary min-vh-100">
            <div class="keen-table-card">
              <div class="keen-table-header d-flex justify-content-between align-items-center">
                <h5>Users List</h5>
              </div>
              <div class="keen-table-responsive">
                <table id="userTable" class="table keen-table align-middle mb-0">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                    </tr>
                  </thead>
                  <tbody>

                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
      fetchUsers();
    });


    function fetchUsers() {
      $.ajax({
        url: './../models/User.php?action=fetch',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            let tableBody = '';
            data.response.forEach(function(user) {
              tableBody += `<tr data-crud-id="${user.id}">
                                <td>${user.id}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                            </tr>`;
            });
            $('#userTable tbody').html(tableBody);
          } else {
            $('#userTable tbody').html('<tr><td colspan="4">No users found.</td></tr>');
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX request failed:', error);
        }
      });
    }

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
