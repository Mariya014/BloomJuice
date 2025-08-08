<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
$customerId = $user['id']; // Assuming your table has an 'id' column

// Folder to store uploads
$targetDir = "uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profilepic'])) {
    $file = $_FILES['profilepic'];
    $fileName = basename($file['name']);
    $targetFile = $targetDir . time() . "_" . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate image type and size (optional)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.'); window.history.back();</script>";
        exit();
    }

    if ($file['size'] > 2 * 1024 * 1024) { // 2MB limit
        echo "<script>alert('File size exceeds 2MB.'); window.history.back();</script>";
        exit();
    }

    // Upload file
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Update DB
        $conn = new mysqli("localhost", "root", "", "bloomcrm");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $imageFile = basename($targetFile);
        $stmt = $conn->prepare("UPDATE customers SET profile_image=? WHERE id=?");
        $stmt->bind_param("si", $imageFile, $customerId);
        $stmt->execute();
        $stmt->close();

        // Refresh session user data
        $result = $conn->query("SELECT * FROM customers WHERE id = $customerId");
        if ($result->num_rows == 1) {
            $_SESSION['user'] = $result->fetch_assoc();
        }

        $conn->close();
        header("Location: profile.php");
        exit();
    } else {
        echo "<script>alert('Failed to upload image.'); window.history.back();</script>";
        exit();
    }
}
?>
