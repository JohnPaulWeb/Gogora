<?php
include 'db.php';  // Include database connection

$errors = array();  // Array to hold error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // No changes here
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $userType = isset($_POST['userType']) ? $_POST['userType'] : 'Regular';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Basic validation
    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($email) || empty($role)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 8 || strlen($password) > 16) {
        $errors[] = "Password must be between 8 and 16 characters.";
    }

    // Check if username or email already exists
    $checkUserQuery = "SELECT COUNT(*) FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $errors[] = "Username or email already exists.";
    }

    // If no errors, proceed with inserting the user
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Insert user data into the database
        $insertQuery = "INSERT INTO users (username, firstname, lastname, password, email, role, user_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        // Use the plain password directly
        $stmt->bind_param("sssssss", $username, $firstName, $lastName, $hashedPassword, $email, $role, $userType);
    
        if ($stmt->execute()) {
            // Return a JSON response for successful registration
            echo json_encode(['success' => true, 'message' => 'Registration successful!']);


            header('Location: ../../view/manager/manage.php'); 
            exit;
        } else {
            // Error inserting data
            $errors[] = "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
    // If there are errors, display them in JSON format
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    }

    $conn->close();  // Close the database connection
}
?>