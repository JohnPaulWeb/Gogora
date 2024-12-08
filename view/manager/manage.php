<?php include('../../control/includes/db.php');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $_POST['password'];
  
  // Query to check if username exists
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      // Verify the password
      if (password_verify($password, $user['password'])) {
          // Password is correct, create session
          $_SESSION['user_id'] = $user['user_id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['role'] = $user['role'];
          $_SESSION['user_type'] = $user['user_type'];
          
          // Update user status to Online
          $update_sql = "UPDATE users SET user_status = 'Online' WHERE user_id = ?";
          $update_stmt = $conn->prepare($update_sql);
          $update_stmt->bind_param("i", $user['user_id']);
          $update_stmt->execute();
          
          // Redirect based on role
          if ($user['role'] == 'Student') {
              header("Location: ../../view/manager/dashboard.php");
          } else if ($user['role'] == 'Faculty') {
              header("Location: ../../view/manager/account.php");
          } else if ($user['role'] == 'Employee') {
            header("Location: ../../view/manager/route.php");
          }
          exit();
      } else {
          $error = "Invalid password";
      }
  } else {
      $error = "Username not found";
  }
  
  $stmt->close();
}

$conn->close();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora</title>
    <link rel="icon" type="image/png" href="../admin/assets/assets/favicon.png">
    <link rel="stylesheet" href="manager.css">
  </head>
  <body>
  <!-- <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?> -->
    <div class="container">
      <div class="left-section">
        <div class="promo-content">
          <img src="../admin/assets/assets/logo.png" alt="GoGora Logo" class="promo-logo">
          <h1 class="promo-title">GoGora</h1>
          <p class="promo-subtitle">Your journey, our pride!</p>
        </div>
      </div>
      <div class="right-section">
        <!-- Registration Form -->
        <form class="registration-form" method="POST" autocomplete="off">
        <h2>Welcome Here in GoraGora</h2>  
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Choose a username" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter a password" required>
        </div>
      <button type="submit" class="register-btn">Login</button>
      <p class="login-text">Dont have an account? <a href="../passenger/index.php" id="show-login-form">Sign Up</a></p>

  </form>

  </body>
</html>