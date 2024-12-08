<?php
session_start();
$user_id = $_SESSION['user_id']; // Assuming user is logged in and user_id is stored in session
$selected_avatar = $_POST['selected_avatar'];

// Database connection (replace with your own connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gogora_images";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update avatar path in the database
$sql = "UPDATE users SET avatar = '$selected_avatar' WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "Avatar updated successfully";
    header('Location: updateavatar.php'); // Redirect to update avatar page
} else {
    echo "Error updating avatar: " . $conn->error;
}

$conn->close();
?>
