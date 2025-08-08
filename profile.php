<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.html");
$user = $_SESSION['user'];
$profileImg = isset($user['profile_image']) && file_exists("uploads/" . $user['profile_image']) 
  ? "uploads/" . $user['profile_image'] 
  : "images/default-avatar.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $user['fullname']; ?>'s Profile</title>
  <link rel="stylesheet" href="css/Styles.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #a7f3d0;
      margin: 0;
    }
    .navbar {
      background-color: #000;
      padding: 10px 20px;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    /* .navbar a {
      color: #fff;
      margin-left: 15px;
      text-decoration: none;
      font-weight: bold;
    } */
    .profile_container {
      max-width: 600px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.08);
      text-align: center;
    }
    .profile-img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #000;
      margin-bottom: 10px;
    }
    .upload-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 15px;
      background: #000;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 6px;
    }
    .info {
      font-size: 16px;
      margin: 10px 0;
    }
    .logout {
      margin-top: 20px;
      display: inline-block;
      color: #fff;
      background: crimson;
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <!-- <div class="navbar">
    <div><strong>Bloom Juice</strong></div>
    <div>
      <a href="index.html">Home</a>
      <a href="review.html">Reviews</a>
      <a href="logout.php">Logout</a>
    </div>
  </div> -->
<!-- Banner -->
  <div class="banner">
    For free shipping on orders over $100 use code <strong>FREESHIPPINGYAY</strong>
  </div>

  <!-- Header / Nav -->
  <header class="site-header">
    <div class="container header-inner">
      <div class="logo">
        <a href="index.html">
          <img src="images/logo.png" alt="Bloom Juice logo" class="logo-img" />
        </a>
      </div>
      <nav class="nav-links">
        <a href="index.html">Home</a>
        <a href="juice.html">Shop</a>
        <a href="logout.php">Logout</a>
        
      </nav>
      <div class="search">
        <input type="search" placeholder="Search product" />
      </div>
    </div>
  </header>

  <!-- Breadcrumb -->
  <nav class="breadcrumb container">
    <a href="index.html">Home</a>
    <span class="sep">›</span>
    <span>Profile</span>
  </nav>
  <div class="profile_container">
    <img src="<?php echo $profileImg; ?>" alt="Profile Picture" class="profile-img">
    <h2><?php echo htmlspecialchars($user['fullname']); ?></h2>
    <p class="info"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

    <form method="POST" action="upload.php" enctype="multipart/form-data">
      <input type="file" name="profilepic" required>
      <br>
      <button type="submit" class="upload-btn">Upload New Picture</button>
    </form>
  </div>
 <!-- Footer -->
  <footer class="site-footer">
    <div class="container footer-top grid-3">
      <div class="logo">
        <img src="images/logo.png" alt="Bloom Juice logo" class="logo-img" />
      </div>
      <div>
        <h4>Help</h4>
        <ul>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Customer service</a></li>
          <li><a href="#">How to guides</a></li>
          <li><a href="#">Contact us</a></li>
        </ul>
      </div>
      <div>
        <h4>Other</h4>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Sitemap</a></li>
          <li><a href="#">Subscriptions</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-newsletter">
      <p>Let’s stay in touch! Sign up to our newsletter and get the best deals!</p>
      <form>
        <input type="email" placeholder="Insert your email address here" />
        <button type="submit" class="btn small">Subscribe now</button>
      </form>
    </div>
    <div class="footer-bottom">
      <img src="images/icon-facebook.svg" alt="Facebook" />
      <img src="images/icon-instagram.svg" alt="Instagram" />
    </div>
  </footer>
</body>
</html>
