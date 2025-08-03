<?php
session_start();

// Clear all session data
$_SESSION = [];
session_destroy();

// Clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #00c6ff, #0072ff);
      color: white;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      background: white;
      color: #333;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }
    .btn-custom {
      background-color: #764ba2;
      color: white;
      border: none;
      padding: 0.5rem 1.2rem;
      border-radius: 0.3rem;
      text-decoration: none;
    }
    .btn-custom:hover {
      background-color: #5e3d91;
      color: white;
    }
  </style>
</head>
<body>
  <div class="card text-center">
    <h2 class="text-success mb-3">You have been logged out!</h2>
    <p class="text-muted">Thank you for using WAPH.</p>
    <a href="form.php" class="btn btn-custom mt-3">← Login Again</a>
  </div>
</body>
</html>
