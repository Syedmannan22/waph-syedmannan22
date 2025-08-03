<?php
// Secure session start
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 15 * 60, // 15 minutes
        'path' => '/',
        'domain' => 'syedmannan22.waph.io', // ✅ your domain
        'secure' => true,     // HTTPS only
        'httponly' => true    // Not accessible via JavaScript
    ]);
    session_start();
}

// Validate session
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true ||
    !isset($_SESSION['browser']) || $_SESSION['browser'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    header("Location: form.php");
    exit();
}
?>
