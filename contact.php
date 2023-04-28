<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="topnav">
    <a href="main.php">
      <img src="logo.jpg" alt="Logo" width="50" height="50">
    </a>
    <a href="contact.php">Contact</a>
    <a href="scoreboard.php">Scoreboard</a>
    <?php if (isset($_SESSION['username'])) { ?>
      <a class="right" href="logout.php">Logout</a>
      <p class="right" href="#"><?php echo $_SESSION['username']; ?></p>
    <?php } else { ?>
      <a class="right" href="login.php">Login</a>
      <a class="right" href="register.php">Register</a>
    <?php } ?>
  </div>
  <div class="select-box">
    <h1>Contact Us</h1>
    <div class="content">
      <ul id="contact-list">
        <li>Phone: 123-456-7890</li>
        <li>Email: info@example.com</li>
        <li>Address: 123 Main St.</li>
        <li>Fax: 123-456-7891</li>
        <li>Facebook: <a href="#">example</a></li>
        <li>Twitter: <a href="#">example</a></li>
      </ul>
      <img src="logo.jpg" alt="Logo" width="50" height="50" id="popup-img">
      <div id="popup" style="display:none">
        <p>This is the pop-up content.</p>
      </div>
      <button id="view-more-btn">View more</button>
      <button id="view-less-btn" style="display:none">View less</button>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="js/contact.js"></script>
    </div>  
  </div> 
  <footer>
    Nothing
  </footer>
</body>
</html>
