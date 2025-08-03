<?php
require "session_auth.php";

// CSRF Protection
$token = $_POST['nocsrftoken'] ?? '';
if (empty($token) || !isset($_SESSION['nocsrftoken']) || $token !== $_SESSION['nocsrftoken']) {
    echo "<script>
            alert('CSRF Attack is detected!');
            window.location.replace('form.php');
          </script>";
    exit();
}

// Get current session username and new password
$username = $_SESSION['username'];
$password = trim($_POST["newpassword"] ?? '');

// Validate input
if (!empty($username) && !empty($password)) {
    if (changepassword($username, $password)) {
        // Regenerate CSRF token
        $_SESSION['nocsrftoken'] = bin2hex(openssl_random_pseudo_bytes(16));
        echo "<script>
                alert('Password has been changed successfully!');
                window.location.href = 'profile.php';
              </script>";
    } else {
        echo "<script>
                alert('Password change failed!');
                window.location.href = 'profile.php';
              </script>";
    }
} else {
    echo "<script>
            alert('No username or password provided!');
            window.location.href='profile.php';
          </script>";
}

// Update password in DB
function changepassword($username, $password) {
    $mysqli = new mysqli('localhost', 'syedmannan22', 'Mannan@123', 'waph');

    if ($mysqli->connect_errno) {
        printf("Database connection failed: %s\n", $mysqli->connect_error);
        return FALSE;
    }

    $sql = "UPDATE users SET password = md5(?) WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $password, $username);
    $result = $stmt->execute();

    $stmt->close();
    $mysqli->close();

    return $result;
}
?>
