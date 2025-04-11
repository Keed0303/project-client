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

      <?php include('./../../pages/components/sidebar.php') ?>

      <!-- Main Content -->
      <div class="col p-4" id="mainContent">
        <button class="btn btn-outline-primary d-md-none mb-3" onclick="toggleSidebar()">
          <i class="bi bi-list"></i>
        </button>
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
          <h3>User</h3>
        </div>


        <div class="col mt-5">
        <button class="btn btn-primary btn-sm mb-3 px-4 py-2" onclick="showCreateForm()">Create</button>
          <div class="card ">
            <div class="card-header text-white">
              <h5 class="mb-0">Users List</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="userTable" class="table table-striped table-bordered mb-0">
                  <thead class="thead-dark">
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


    <!-- View User Details (Displays in a Table) -->
    <div id="viewSection" class="mt-5" style="display:none;">
      <h3>User Details</h3>
      <table class="table">
        <tr>
          <th>Name</th>
          <td id="viewName"></td>
        </tr>
        <tr>
          <th>Email</th>
          <td id="viewEmail"></td>
        </tr>
        <tr>
          <th>Password</th>
          <td id="viewPassword"></td>
        </tr>
      </table>
      <button class="btn btn-secondary" onclick="goBackToTable()">Back to Table</button>
    </div>


    <div id="editSection" class="mt-5" style="display:none;">
      <h3>Edit User</h3>
      <form id="editForm">
        <div class="mb-3">
          <label for="editName" class="form-label">Name:</label>
          <input type="text" class="form-control" id="editName" name="name" required>
        </div>
        <div class="mb-3">
          <label for="editEmail" class="form-label">Email:</label>
          <input type="email" class="form-control" id="editEmail" name="email" required>
        </div>
        <div class="mb-3">
          <label for="editPassword" class="form-label">Password:</label>
          <input type="password" class="form-control" id="editPassword" name="password" required>
        </div>
        <input type="hidden" id="editUserId" name="id">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-secondary" onclick="goBackToTable()">Cancel</button>
      </form>
    </div>
  </div>

  <div id="createSection" style="margin-bottom: 20px;">
  <h4>Create User</h4>
  <form id="createForm">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Create User</button>
  </form>
</div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Fetch users on page load
    $(document).ready(function() {
      $.ajax({
        url: './../../models/User.php?action=fetch',
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
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="viewUser(${user.id})">View</button>
                                    <button class="btn btn-warning btn-sm" onclick="editUser(${user.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Delete</button>
                                </td>
                            </tr>`;
            });
            $('#userTable tbody').html(tableBody); // Insert the table rows
          } else {
            $('#userTable tbody').html('<tr><td colspan="4">No users found.</td></tr>');
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX request failed:', error);
        }
      });
    });

    // View user details in a table format
    function viewUser(id) {
      $.ajax({
        url: './../../models/User.php?action=view&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            $('#viewName').text(data.response.name);
            $('#viewEmail').text(data.response.email);
            $('#viewPassword').text(data.response.password);
            $('#viewSection').show();
            $('#userTable').hide(); // Hide the user table when viewing
          } else {
            alert(data.response);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error viewing user:', error);
        }
      });
    }

    // Go back to the user table from the view section
    function goBackToTable() {
      $('#viewSection').hide();
      $('#editSection').hide();
      $('#userTable').show();
      $('#createSection').show();
    }

    function showCreateForm() {
      $('#viewSection').hide();
      $('#editSection').hide();
      $('#userTable').hide();
      $('#createSection').show();
    }

    // Edit user details
    function editUser(id) {
      $.ajax({
        url: './../../models/User.php?action=view&id=' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            $('#editName').val(data.response.name);
            $('#editEmail').val(data.response.email);
            $('#editPassword').val(data.response.password);
            $('#editUserId').val(data.response.id);
            $('#editSection').show();
            $('#userTable').hide(); // Hide the user table when editing
          } else {
            alert(data.response);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error fetching user for editing:', error);
        }
      });
    }

    // Handle edit form submission
    $('#editForm').submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: './../../models/User.php?action=edit',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data) {
          alert(data.response);
          if (data.success) {
            goBackToTable(); // Go back to table view after edit
            location.reload(); // Reload the page to update the table
          }
        },
        error: function(xhr, status, error) {
          console.error('Error editing user:', error);
        }
      });
    });

    // Delete user
    function deleteUser(id) {
      const crudId = $(this).data('crud-id'); 
      if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
          url: './../../models/User.php?action=delete&id=' + id,
          type: 'GET',
          data: {
            crud_id: crudId,   
          },
          dataType: 'json',
          success: function(data) {
            alert(data.response);
            if (data.success) {
              $(`tr[data-crud-id="${crud_id}"]`).remove();x
            }
          },
          error: function(xhr, status, error) {
            console.error('Error deleting user:', error);
          }
        });
      }
    }

    $('#createForm').submit(function (e) {
      e.preventDefault();
      $.post('your_php_file.php?action=create', $(this).serialize(), function (res) {
        alert("User created!");
        $('#createForm')[0].reset();
        fetchUsers();
      });
    });

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