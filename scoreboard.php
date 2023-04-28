<?php
session_start();
$conn = mysqli_connect(
  'db',
  'admin_x_o',
  'adminpasswordlol',
  'tic_tac_toe'
);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to get total wins for each user
$query = "SELECT username, COUNT(*) as total_wins FROM Games WHERE gameStatus='win' GROUP BY username";
$result = mysqli_query($conn, $query);

// Create an array to store user wins
$user_wins = array();
while ($row = mysqli_fetch_assoc($result)) {
    $user_wins[$row['username']] = $row['total_wins'];
}

// Query to get X wins for each user
$query = "SELECT username, COUNT(*) as X_wins FROM Games WHERE gameStatus='win' AND sign='X' GROUP BY username";
$result = mysqli_query($conn, $query);

// Create an array to store user X wins
$user_X_wins = array();
while ($row = mysqli_fetch_assoc($result)) {
    $user_X_wins[$row['username']] = $row['X_wins'];
}

// Query to get O wins for each user
$query = "SELECT username, COUNT(*) as O_wins FROM Games WHERE gameStatus='win' AND sign='O' GROUP BY username";
$result = mysqli_query($conn, $query);

// Create an array to store user O wins
$user_O_wins = array();
while ($row = mysqli_fetch_assoc($result)) {
    $user_O_wins[$row['username']] = $row['O_wins'];
}

// Combine all user information into one array
$user_info = array();
foreach ($user_wins as $username => $total_wins) {
    $user_info[$username] = array();
    $user_info[$username]['total_wins'] = $total_wins;
    $user_info[$username]['X_wins'] = isset($user_X_wins[$username]) ? $user_X_wins[$username] : 0;
    $user_info[$username]['O_wins'] = isset($user_O_wins[$username]) ? $user_O_wins[$username] : 0;
}

// Calculate win percentages for each user
foreach ($user_info as $username => $info) {
    $total_wins = $info['total_wins'];
    $X_wins = $info['X_wins'];
    $O_wins = $info['O_wins'];
    $user_info[$username]['X_percent'] = $total_wins > 0 ? round(($X_wins / $total_wins) * 100, 2) . "%" : "0%";
    $user_info[$username]['O_percent'] = $total_wins > 0 ? round(($O_wins / $total_wins) * 100, 2) . "%" : "0%";
}



// Sort user information by total wins
uasort($user_info, function ($a, $b) {
    return $b['total_wins'] - $a['total_wins'];
});

// Search functionality
$search_term = isset($_GET['search']) ? $_GET['search'] : "";
$search_results = array();
if ($search_term) {
    foreach ($user_info as $username => $info) {
        if (stripos($username, $search_term) !== false) {
            $search_results[$username] = $info;
        }
    }
    $user_info = $search_results;
}

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
            <th>X Win %</th>
            <th>O Win %</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user_info as $username => $info) { ?>
    <tr>
        <td><?php echo $username ?></td>
        <td><?php echo $info['total_wins'] ?></td>
        <td><?php echo $info['X_percent'] ?></td>
        <td><?php echo $info['O_percent'] ?></td>
    </tr>
<?php } ?>
        </tbody>
    </table>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scoreboard.js"></script>
</body>
</html>

