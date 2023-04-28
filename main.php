<?php
    session_start();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tic Tac Toe Game </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
</head>
<body>
  <?php
   if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      echo '<div class="topnav">
        <a href="main.php">
          <img src="logo.jpg" alt="Logo" width="50" height="50">
        </a>

        <a href="contact.php">Contact</a>
        <a href="scoreboard.php">Scoreboard</a>
        <a class ="right" href="logout.php">Logout</a>
        <a class="right" href="#">'.$username.'</a>
      </div>';
    } else {
      echo '<div class="topnav">
        <a href="main.php">
          <img src="logo.jpg" alt="Logo" width="50" height="50">
        </a>

        <a href="contact.php">Contact</a>
        <a href="scoreboard.php">Scoreboard</a>
        <a class="right" href="login.php">Login</a>
        <a class="right" href="register.php">Register</a>
      </div>';
    }
  ?>

<!-- Select Box -->
  <div class="select-box">
    <header>Tic Tac Toe</header>
    <div class="content">
      <div class="title">Select which you want to be?</div>
      <?php
       if(isset($_SESSION['username'])){
        echo '<div class="options">
            <button class="playerX">Player (X)</button>
            <button class="playerO">Player (O)</button>
        </div>';
    } else {
        echo '<div class="options">
            <a href="login.php"><button class="playerX">Player (X)</button></a>
            <a href="login.php"><button class="playerO">Player (O)</button></a>
        </div>';
    }
    ?>




    </div>
  </div> 


  </div>
  <!-- Player Board -->
  <div class="play-board">
    <div class="details">
      <div class="players">
        <span class="Xturn">X's Turn</span>
        <span class="Oturn">O's Turn</span>
        <div class="slider"></div>
      </div>
    </div>
    <div class="play-area">
      <div class="game-row">
        <span class="box1"></span>
        <span class="box2"></span>
        <span class="box3"></span>
      </div>
      <div class="game-row">
        <span class="box4"></span>
        <span class="box5"></span>
        <span class="box6"></span>
      </div>
      <div class="game-row">
        <span class="box7"></span>
        <span class="box8"></span>
        <span class="box9"></span>
      </div>
    </div>
  </div>
<!-- Results -->

  
  <div class="result-box">
    <div class="won-text"></div>
    <div class="btn"><button>Replay</button></div>
  </div>

  <script src="js/script.js"></script>
  
</body>

<footer>
    Nothing
</footer>
</html>
