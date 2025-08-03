<?php
require "session_auth.php";

$username = $_SESSION['username'];

// Generate CSRF token if not already set
if (empty($_SESSION['nocsrftoken'])) {
    $_SESSION['nocsrftoken'] = bin2hex(openssl_random_pseudo_bytes(16));
}

// DB connect
$mysqli = new mysqli('localhost', 'syedmannan22', 'Mannan@123', 'waph');
if ($mysqli->connect_errno) {
    die("DB connection failed.");
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['nocsrftoken'] ?? '';
    if (empty($token) || !isset($_SESSION['nocsrftoken']) || $token !== $_SESSION['nocsrftoken']) {
        echo "<script>
            alert('CSRF Attack Detected!');
            window.location.replace('form.php');
        </script>";
        exit();
    }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $mysqli->prepare("UPDATE users SET name=?, email=? WHERE username=?");
        $stmt->bind_param("sss", $name, $email, $username);
        $stmt->execute();
        $stmt->close();

        // Regenerate token
        $_SESSION['nocsrftoken'] = bin2hex(openssl_random_pseudo_bytes(16));

        echo "<script>
            alert('Profile updated successfully!');
            window.location.href = 'profile.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Invalid input. Please try again.');
            window.location.href = 'editprofile.php';
        </script>";
        exit();
    }
}

// Fetch existing user data
$stmt = $mysqli->prepare("SELECT name, email FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - WAPH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            background: #fff;
            color: #333;
            border-radius: 1rem;
        }

        .btn-custom {
            background-color: #764ba2;
            color: #fff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #5e3d91;
        }

        a {
            color: #764ba2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-3">Edit Profile</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" value="<?php echo htmlentities($name); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" value="<?php echo htmlentities($email); ?>" class="form-control" required>
                </div>
                <input type="hidden" name="nocsrftoken" value="<?php echo $_SESSION['nocsrftoken']; ?>"/>
                <button type="submit" class="btn btn-custom w-100">Update Profile</button>
                <div class="text-center mt-3">
                    <a href="profile.php" class="btn btn-outline-primary">← Back to Profile</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
