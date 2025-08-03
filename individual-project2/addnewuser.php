<?php  
session_start();

// CSRF Protection
$token = $_POST['nocsrftoken'] ?? '';
if (empty($token) || !isset($_SESSION['nocsrftoken']) || $token !== $_SESSION['nocsrftoken']) {
    echo "<script>
            alert('CSRF Attack is detected!');
            window.location.href = 'registrationform.php';
          </script>";
    exit();
}

// Get form data
$username = trim($_POST["username"] ?? '');
$password = trim($_POST["password"] ?? '');
$name     = trim($_POST["name"] ?? '');
$email    = trim($_POST["email"] ?? '');

// Server-side validation
if (empty($username) || empty($password) || empty($name) || empty($email)) {
    echo "<script>alert('All fields are required!'); window.history.back();</script>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format!'); window.history.back();</script>";
    exit();
}

// Attempt to add new user
if (addnewuser($username, $password, $name, $email)) {
    // Regenerate CSRF token after successful operation
    $_SESSION['nocsrftoken'] = bin2hex(openssl_random_pseudo_bytes(16));

    echo "<script>alert('Registration Succeeded!'); window.location.href = 'form.php';</script>";
} else {
    echo "<script>alert('Registration failed! Username may already exist.'); window.history.back();</script>";
}

// Function to insert new user into DB
function addnewuser($username, $password, $name, $email) {
    $mysqli = new mysqli('localhost', 'syedmannan22', 'Mannan@123', 'waph');
    
    if ($mysqli->connect_errno) {
        printf("Database connection failed: %s\n", $mysqli->connect_error);
        return FALSE;
    }

    // Check if username already exists
    $check = $mysqli->prepare("SELECT username FROM users WHERE username=?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();
    
    if ($check->num_rows > 0) {
        $check->close();
        $mysqli->close();
        return FALSE; // Username exists
    }
    $check->close();

    // Insert new user
    $sql = "INSERT INTO users(username, password, name, email) VALUES (?, md5(?), ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $name, $email);
    $result = $stmt->execute();

    $stmt->close();
    $mysqli->close();
    return $result;
}
?>
