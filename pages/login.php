<?php
// Start the session to store user data after login
session_start();

// Include the database connection file
include '../config/connect.php';

try {
  // Variable to hold feedback message (success or error)
  $message = '';

  // Check if the form was submitted using POST method
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Get the email and password from the submitted form data
      $email = $_POST['email'] ?? ''; // Use null coalescing operator to handle missing values
      $password = $_POST['password'] ?? '';

      // Prepare a SQL query to find the user with the given email
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
      $stmt->execute([$email]); // Run the query with the user's email
      $user = $stmt->fetch(PDO::FETCH_ASSOC); // Get the result as an associative array

      // Check if the user exists and the password is correct
      if ($user && password_verify($password, $user['password'])) {
          // If login is successful
          $message = '<div class="alert alert-success">Login successful!</div>';

          // Save user info in the session
          $_SESSION['user'] = $user;

          // Redirect to the dashboard
          header("Location: dashboard.php");
          exit(); // Make sure to stop the script after redirect
      } else {
          // If login fails
          $message = '<div class="alert alert-danger">Invalid email or password.</div>';
      }
  }
} catch (PDOException $e) {
  // Handle any database connection errors
  $message = '<div class="alert alert-danger">Connection failed: ' . $e->getMessage() . '</div>';
}
?>

<!-- HTML starts here -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Include Bootstrap CSS for styling -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="icon" type="image/png" href="/favicon.png">

  <title>Login - TechCare</title>
</head>
<body>

  <!-- Centered login card using Bootstrap -->
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
      <h4 class="text-center mb-4 text-primary">Login to TechCare</h4>

      <!-- Login form -->
      <form method="post">
        <!-- Show success or error message here -->
        <?= $message ?? '' ?>

        <!-- Email input -->
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <!-- Password input -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>

      <!-- Link for password recovery -->
      <div class="text-center mt-3">
        <a href="#" class="text-decoration-none">Forgot password?</a>
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JavaScript (for responsive components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
