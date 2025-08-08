<?php
$host = "localhost";
$dbname = "bloomcrm";
$username = "root";
$password = "";


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$fullname = $_POST['fullname'];
$email = $_POST['email'];
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);


$sql = "INSERT INTO customers (fullname, email, username, password) 
        VALUES ('$fullname', '$email', '$user', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registration successful!'); window.location.href='customer_login.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
