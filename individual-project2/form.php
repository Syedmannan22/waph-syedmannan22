<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - WAPH</title>
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
      padding: 2rem;
    }

    .btn-custom {
      background-color: #764ba2;
      color: #fff;
      border: none;
      width: 100%;
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

    #digit-clock {
      font-weight: bold;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-2">WAPH Login</h2>
      <div id="digit-clock" class="text-center mb-3"></div>

      <form action="index.php" method="POST">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-custom">Login</button>
      </form>

      <div class="text-center mt-3">
        <a href="registrationform.php">New user? Register</a>
      </div>
    </div>
  </div>

  <script>
    function displayTime() {
      const options = { month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
      document.getElementById('digit-clock').innerHTML = 
          "Current time: " + new Date().toLocaleString('en-US', options).replace(/,/, '');
    }
    setInterval(displayTime, 500);
  </script>
</body>
</html>
