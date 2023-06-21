<?php
// Get values from the login form
$username = $_POST['user'];
$password = $_POST['pass'];

// To prevent SQL injection
$username = stripslashes($username);
$password = stripslashes($password);

// Connect to the server and select the database
$conn = mysqli_connect("localhost", "root", "", "application");
if (!$conn) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Escape special characters to prevent SQL injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query the database for the user
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    echo "Login success!!! Welcome " . $row['username'];
} else {
    echo "Failed to login!";
}
?>