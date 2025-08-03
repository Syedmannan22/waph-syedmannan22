<?php
require "session_auth.php";

$username = $_SESSION['username'];

// Connect to DB
$mysqli = new mysqli('localhost', 'syedmannan22', 'Mannan@123', 'waph');
if ($mysqli->connect_errno) {
    echo "<div class='alert alert-danger text-center mt-5'>Database connection failed: {$mysqli->connect_error}</div>";
    exit();
}

// Fetch user info
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
    <title>Your Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #43cea2, #185a9d);
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
        }
        .btn-custom:hover {
            background-color: #5e3d91;
            color: white;
        }
    </style>
    <script>
        function displayTime() {
            const options = { month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            document.getElementById('digit-clock').innerHTML =
                "Current time: " + new Date().toLocaleString('en-US', options).replace(/,/, '');
        }
        setInterval(displayTime, 500);
    </script>
</head>
<body>
    <div class="card text-center" style="max-width: 500px;">
        <h2 class="mb-3">Welcome, <?php echo htmlentities($username); ?>!</h2>
        <div id="digit-clock" class="mb-3 text-muted"></div>
        <p><strong>Name:</strong> <?php echo htmlentities($name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlentities($email); ?></p>

        <div class="d-grid gap-2 mt-4">
            <a href="editprofile.php" class="btn btn-custom">Edit Profile</a>
            <a href="changepasswordform.php" class="btn btn-warning">Change Password</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
