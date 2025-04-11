<?php

require_once "connect.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $myemail = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
  $mypassword = mysqli_real_escape_string($conn, $_POST['password'] ?? '');

  $sql = "SELECT id FROM `users` WHERE email = '$myemail' AND password = '$mypassword'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if ($count === 1) {
    $_SESSION['user'] = $row;
    header("Location: index.php");
    exit;
  } else {
    header("Location: login.php?error=1"); // optional: show login error
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="icon" type="image/png" href="/favicon.png">

  <title>Document</title>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
      <h4 class="text-center mb-4 text-primary">Login to TechCare</h4>
      <form method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
      <div class="text-center mt-3">
        <a href="#" class="text-decoration-none">Forgot password?</a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>