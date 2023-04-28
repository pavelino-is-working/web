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

// Check if form submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if user exists in database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;

        // Redirect to main.php
        header('Location: main.php');
        exit;
    } else {
        // Return error message as JSON
        $response = array(
            "status" => "error",
            "message" => "Incorrect email/username or password. Please try again."
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/login.js"></script>
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
    <form action="login.php" method="post" onsubmit="return validateForm()">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
    <div id="message"></div>
    <footer>
        Nothing
    </footer>
</body>
</html>
