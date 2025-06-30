<?php
session_start();    

function checklogin_mysql($username, $password) {
    $mysqli = new mysqli("localhost", "syedmannan22", "Mannan@123", "waph");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$username' AND password = md5('$password')";
    echo "DEBUG>sql= $sql<br>"; // For debugging

    $result = $mysqli->query($sql);
    
    if ($result && $result->num_rows > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

if (checklogin_mysql($_POST["username"], $_POST["password"])) {
    echo "<h2> Welcome " . htmlspecialchars($_POST['username']) . " !</h2>";
} else {
    echo "<script>alert('Invalid username/password'); window.location='form.php';</script>";
    die();
}
?>

