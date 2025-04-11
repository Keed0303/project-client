<?php
include "./../config/connect.php";

$action = $_GET['action'];

switch($action) {
  case 'create':
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple validation
    if ($name && $email && $password) {
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
      $result = $stmt->execute([$name, $email, $password]);

      echo json_encode([
        'success' => $result,
        'message' => $result ? 'User created successfully.' : 'Failed to create user.'
      ]);
    } else {
      echo json_encode([
        'success' => false,
        'message' => 'All fields are required.'
      ]);
    }
    break;
  case 'fetch':
    $stmt = $pdo->query("SELECT * FROM users");
    $output = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $output[] = $row;
    }
    echo json_encode([
      'success' => true,
      'response' => $output
    ]);
    break;

  case 'view':
    $id = $_GET['id'] ?? 1;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
          'success' => true,
          'response' => $row
        ]);
    } else {
        echo json_encode([
          'success' => false,
          'response' => "No user found with ID = $id"
        ]);
    }
    break;

  case 'edit':
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($id && $name && $email && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $success = $stmt->execute([$name, $email, $hashedPassword, $id]);

        echo json_encode([
          'success' => $success,
          'response' => $success ? "User updated successfully." : "Failed to update user."
        ]);
    } else {
        echo json_encode([
          'success' => false,
          'response' => "Missing required fields."
        ]);
    }
    break;

  case 'delete':
    $id = $_GET['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $success = $stmt->execute([$id]);

        echo json_encode([
          'success' => $success,
          'response' => $success ? "User deleted successfully." : "Failed to delete user."
        ]);
    } else {
        echo json_encode([
          'success' => false,
          'response' => "ID not provided."
        ]);
    }
    break;
}
