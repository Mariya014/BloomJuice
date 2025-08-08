<?php
// Static credentials
$admin_user = 'admin';
$admin_pass = 'admin123';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        header("Location: admin-dashboard.html");
        exit();
    } else {
        header("Location: admin-login.html?error=1");
        exit();
    }
}
?>
