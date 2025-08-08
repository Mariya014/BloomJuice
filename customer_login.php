<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bloomcrm");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM customers WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['user'] = $row;
    header("Location: profile.php");
    exit();
  }
}
echo "<script>alert('Invalid credentials'); window.location='customer_login.html';</script>";
$conn->close();
?>