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

// Get the username from the session
$username = $_SESSION['username'];

// Get the sign and game status from the POST parameters
$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$sign = $data->sign;
$gameStatus = $data->gameStatus;



// Insert the game data into the database
$sql = "INSERT INTO Games (username, sign, gameStatus) VALUES ('$username', '$sign', '$gameStatus')";
mysqli_query($conn, $sql);

// Send a response back to the AJAX request
echo "Game data saved successfully!";
?>
