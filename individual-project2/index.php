<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $mysqli = new mysqli('localhost', 'syedmannan22', 'Mannan@123', 'waph');

        if ($mysqli->connect_errno) {
            showError("Database connection failed: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("SELECT username FROM users WHERE username=? AND password=md5(?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            session_regenerate_id(true);
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
            header("Location: profile.php");
            exit();
        } else {
            showError("Invalid username or password.");
        }

        $stmt->close();
        $mysqli->close();
    } else {
        showError("Please enter both username and password.");
    }
} else {
    header("Location: form.php");
    exit();
}

// Utility function
function showError($message) {
    $safeMsg = htmlentities($message);
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login Error</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
          body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
          }
          .card {
            background-color: white;
            color: black;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
          }
          .btn-custom {
            background-color: #764ba2;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
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
            <h4 class="mb-3">Login Error</h4>
            <div class="alert alert-danger">{$safeMsg}</div>
            <a href="form.php" class="btn btn-custom mt-3">← Try Again</a>
        </div>
    </body>
    </html>
HTML;
    exit();
}
?>
