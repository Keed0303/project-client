<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BentaBox Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
