<?php
require "session_auth.php";

// Generate CSRF token
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Change Password - WAPH</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
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

    #digit-clock {
      font-weight: bold;
      font-size: 1.1rem;
    }

    a {
      color: #764ba2;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>

  <script>
    function displayTime() {
      const options = {
        month: 'short', day: '2-digit',
        hour: '2-digit', minute: '2-digit', second: '2-digit',
        hour12: true
      };
      document.getElementById('digit-clock').innerHTML =
        "Current time: " + new Date().toLocaleString('en-US', options).replace(/,/, '');
    }
    setInterval(displayTime, 500);
  </script>
</head>
<body>
  <div class="container py-5">
    <h1 class="text-center mb-3">Change Password</h1>
    <p class="text-center text-light">Use this form to update your account password securely.</p>

    <div id="digit-clock" class="text-center mb-1"></div>
    <p class="text-center text-light">Visited time: <?php echo date("M-d h:i:sa") ?></p>

    <div class="card shadow-lg p-4 mx-auto mt-3" style="max-width: 500px;">
      <form action="changepassword.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Username:</label>
          <input type="text" class="form-control" value="<?php echo htmlentities($_SESSION['username']); ?>" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">New Password:</label>
          <input type="password" class="form-control" name="newpassword" required>
        </div>
        <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>">
        <button type="submit" class="btn btn-custom w-100">Change Password</button>
      </form>
      <div class="text-center mt-3">
        <a href="profile.php" class="btn btn-outline-primary">← Back to Profile</a>
      </div>
    </div>
  </div>
</body>
</html>
