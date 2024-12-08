<?php
require('db.php');  
session_start();

// Retrieve the username and password from the form submission
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Check if a session already exists for the user
if (isset($_SESSION['user_id'])) {
    // Retrieve user status from the database
    $statusSQL = "SELECT user_status FROM users WHERE user_id = ?";
    $statusstmt = $conn->prepare($statusSQL);
    $statusstmt->bind_param("i", $_SESSION['user_id']);
    $statusstmt->execute();
    $statusresult = $statusstmt->get_result();

    if ($statusresult->num_rows > 0) {
        $statusrow = $statusresult->fetch_assoc();
        if ($statusrow['user_status'] === 'Online') {
            // User is already logged in
            echo json_encode(['success' => false, 'message' => 'You are already logged in.']);


        }
    }
    $statusstmt->close();
}

// Prepare an SQL statement to select user data where the username matches
$loginSQL = "SELECT user_id, password, username, role, user_type FROM users WHERE username = ?";

$loginstmt = $conn->prepare($loginSQL);  // Prepare the SQL statement
$loginstmt->bind_param("s", $username);  // Bind the username to the prepared statement
$loginstmt->execute();  // Execute the statement

$result = $loginstmt->get_result();  // Get the result of the query

// Check if the user exists in the database
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  // Fetch the row of data for the user

    // Verify the input password matches the stored password (no hashing in your case)
    if (password_verify($password, $row['password'])) {
        // Successful login, return success as JSON
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['user_status'] = "Online";

        // Update user status in the database (if necessary)
        $updateSQL = "UPDATE users SET user_status = 'Online' WHERE user_id = ?";
        $updatestmt = $conn->prepare($updateSQL);
        $updatestmt->bind_param("i", $_SESSION['user_id']);
        $updatestmt->execute();
        $updatestmt->close();
    
        echo json_encode(['success' => true, 'message' => 'Login successful!']);

        // header('Location: ../../view/manager/manage.php'); 
        //     exit;
        
    } else {
        // Invalid password, return failure as JSON
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
} else {
    // User not found, return failure as JSON
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

$loginstmt->close();    
$conn->close(); 
?>
