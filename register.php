<?php
// Connect to database
$conn = mysqli_connect(
    'db',
    'admin_x_o',
    'adminpasswordlol',
    'tic_tac_toe'
);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve countries from database
$countries = array();
$sql = "SELECT * FROM Countries";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $countries[$row['id']] = $row['name'];
    }
}

// Retrieve cities from database
$cities = array();
$sql = "SELECT * FROM Cities";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (!isset($cities[$row['country_id']])) {
            $cities[$row['country_id']] = array();
        }
        $cities[$row['country_id']][$row['id']] = $row['name'];
    }
}

// Get form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $country_id = $_POST["country"];
    $city_id = $_POST["city"];

    // Check if user already exists
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $response = array(
            'status' => 'error',
            'message' => 'User already exists'
        );
    } else {
        // Insert new user into database
        $sql = "INSERT INTO users (username, email, password, country_id, city_id) VALUES ('$username', '$email', '$password', '$country_id', '$city_id')";
        if (mysqli_query($conn, $sql)) {
            $response = array(
                'status' => 'success',
                'message' => 'New user added successfully'
            );
            header('Location: login.php');
            exit();
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error: ' . $sql . '<br>' . mysqli_error($conn)
            );
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register </title>
    <link rel="stylesheet" href="style.css">
    <script src="js/register.js"></script>
</head>
<body>
    <div class="topnav">
        <a href="main.php">
            <img src="logo.jpg" alt="Logo" width="50" height="50">
        </a>
        <a href="contact.php">Contact</a>
        <a href="scoreboard.php">Scoreboard</a>
        <a class="right" href="login.php">Login</a>
        <a class="right" href="register.php">Register</a>
  
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
        <h2>Register</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="country">Country</label>
        <select id="country" name="country" required>
            <option value="">-- Select Country --</option>
            <?php foreach ($countries as $id => $name): ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php endforeach; ?>
        </select>

        <label for="city">City</label>
        <select id="city" name="city" required>
            <option value="">-- Select City --</option>
        </select>

        <input type="submit" value="Register">
    </form>

    <script>
        // Populate city dropdown based on selected country
        var cities = <?php echo json_encode($cities) ?>;
        var countrySelect = document.getElementById("country");
        var citySelect = document.getElementById("city");

        countrySelect.addEventListener("change", function() {
            var countryId = this.value;
            citySelect.innerHTML = "<option value=''>-- Select City --</option>";
            if (cities[countryId]) {
                for (var cityId in cities[countryId]) {
                    var cityName = cities[countryId][cityId];
                    citySelect.innerHTML += "<option value='" + cityId + "'>" + cityName + "</option>";
                }
            }
        });
    </script>
</body>
</html>
