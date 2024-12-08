<?php
require('db.php');  // Include database connection
session_start();    // Start the session to manage user login state

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Update user status to offline in the database
    $updateSQL = "UPDATE users SET user_status = 'Offline' WHERE user_id = ?";
    $updatestmt = $conn->prepare($updateSQL);
    $updatestmt->bind_param("i", $_SESSION['user_id']);
    $updatestmt->execute();
    $updatestmt->close();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or another appropriate page
    header("Location: ../../view/manager/manage.php");
    $conn->close();  // Close the database connection
    exit;
} else {
    // User is not logged in, redirect to the login page
    header("Location: ../../view/manager/manage.php");
    $conn->close();  // Close the database connection
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Hello world</h1>
    
</body>
</html>
