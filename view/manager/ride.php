<?php include('../../control/includes/db.php');
if(!empty($_SESSION["id"])){
    header("Location: ../../view/manager/ride.php");
}

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
    header("Location: ../../view/manager/dashboard.php");
    $conn->close();  // Close the database connection
    exit;
} else {
    // User is not logged in, redirect to the login page
    header("Location: ../../view/manager/route.php");
    $conn->close();  // Close the database connection
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora - Ride Management</title>
    <link rel="stylesheet" href="../manager/css/ride.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>GoGora</h2>
            </div>
            <div class="manager-label">MANAGER</div>
            <nav>
                <ul>
                    <li><a href="../manager/dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
                    <li><a href="#" class="active"><span class="icon">🚗</span> Ride Management</a></li>
                    <li><a href="../manager/route.php"> <span class="icon">👥</span>  Route Management</a></li>
                    <li><a href="../manager/account.php"><span class="icon">👤</span> Account Management</a></li>
                <li><a href="../manager/prioritylane.php"><span class="icon">⭐</span> Priority Lane Management</a></li>
                <li><a href="#"><span class="icon">📝</span> Reservations</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="/control/includes/logout.php"><img src="logout-icon.png" alt=""> Logout</a>
            </div>
        </aside>

        <main class="content">
            <div class="header">
                <h1>Manage Rides</h1>
            </div>

            <div class="form-container">
                <h2>ADD A RIDE</h2>
                <form action="process-ride.php" method="POST">
                    <div class="form-group">
                        <label for="plate">Plate Number</label>
                        <input type="text" id="plate" name="plate" required>
                    </div>

                    <div class="form-group">
                        <label for="type">Type of Ride</label>
                        <select id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="shuttle">Shuttle Service</option>
                            <option value="bus">Bus</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Seating Capacity</label>
                        <input type="number" id="capacity" name="capacity" required>
                    </div>

                    <div class="form-group">
                        <label for="route">Route</label>
                        <input type="text" id="route" name="route" required>
                    </div>

                    <div class="form-group">
                        <label for="schedule">Schedule</label>
                        <input type="text" id="schedule" name="schedule" required>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-primary">Add ride</button>
                        <button type="button" class="btn-secondary" onclick="history.back()">BACK</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>