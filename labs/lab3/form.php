<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Login page</title>
  <script type="text/javascript">
      function displayTime() {
        const options = {
          month: 'short',
          day: '2-digit',
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit',
          hour12: true
        };
        const formattedTime = new Date().toLocaleString('en-US', options).replace(/,/, '');
        document.getElementById('digit-clock').innerHTML = "Current time:" + formattedTime;
      }
      setInterval(displayTime, 500);
  </script>
</head>
<body>
  <h1>A Simple login form, WAPH</h1>
  <h2>Student Name</h2>
  <div id="digit-clock"></div>  
<?php
  echo "Visited time: " . date("Y-m-d h:i:sa");
?>
  <form action="index.php" method="POST" class="form login">
    Username:<input type="text" name="username" /> <br>
    Password: <input type="password" name="password" /> <br>
    <button type="submit">Login</button>
  </form>
</body>
</html>

