<?php
  include './../../config/connect.php';

  $id = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  $action = $_GET['action'];
?>

<h2>Edit User</h2>
<div id="alert-container"></div>

<form id="update-form" method="POST">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <input type="text" name="name" value="<?= $row['name'] ?>" required class="form-control mb-2">
  <input type="email" name="email" value="<?= $row['email'] ?>" required class="form-control mb-2">
  <button type="submit" name="update" class="btn btn-success">Update</button>
</form>

<script>
  $(document).ready(function () { 
    $('#update-form').submit(function(e){
      e.preventDefault();

      const formData = {
        id: $(this).find('[name="id"]').val(),
        name: $(this).find('[name="name"]').val(),
        email: $(this).find('[name="email"]').val()
      };

      $.ajax({
          type: 'PUT',
          url: `./../../models/User.php?action=edit&id=${formData.id}`,
          data: formData,
          success: function (response) {
              if (response.success) {
                  $('#alert-container').html(<div class="alert alert-success">${response.message}</div>);

              } else {
                  $('#alert-container').html(<div class="alert alert-danger">${response.message}</div>);
              }
              
          },
          error: function (xhr) {
            const errors = xhr.responseJSON.errors;
            
          }
      });
    });
  });
</script>