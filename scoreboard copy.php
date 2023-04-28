<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Tic Tac Toe Scoreboard</title>
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
    <div class="score-table">
      <h1>Tic Tac Toe Scoreboard</h1>
      <input type="text" id="search" placeholder="Search by username...">
      <button id="sort-btn">Sort by Win X %</button>
      <table>
        <thead>
          <tr>
            <th>Username</th>
            <th>Total Wins</th>
            <th>Win X %</th>
            <th>Win O %</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John Doe</td>
            <td>10</td>
            <td>50%</td>
            <td>50%</td>
          </tr>
          <tr>
            <td>Jane Doe</td>
            <td>5</td>
            <td>25%</td>
            <td>75%</td>
          </tr>
          <tr>
            <td>Bob Smith</td>
            <td>3</td>
            <td>100%</td>
            <td>0%</td>
          </tr>
        </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scoreboard.js"></script>
  </body>
</html>
