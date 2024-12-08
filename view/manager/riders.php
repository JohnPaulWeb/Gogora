<?php include('../../control/includes/db.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

    // Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $ride_id = $_POST['ride_id'];
    $plate_number = $_POST['plate_number'];
    $route = $_POST['route'];
    $time = $_POST['time'];
    $seats_available = $_POST['seats_available'];
    $ride_type = $_POST['ride_type'];
    $departure = $_POST['departure'];
    $capacity = $_POST['capacity'];
    
    $sql = "UPDATE rides SET 
            plate_number = ?, 
            route = ?,
            time = ?,
            seats_available = ?,
            ride_type = ?,
            departure = ?,
            capacity = ?
            WHERE ride_id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssi", 
        $plate_number,
        $route,
        $time,
        $seats_available,
        $ride_type,
        $departure,
        $capacity,
        $ride_id
    );
    
    if ($stmt->execute()) {
        $message = "Ride updated successfully";
    } else {
        $message = "Error updating ride: " . $conn->error;
    }
    
    $stmt->close();
}

// Fetch ride data if ID is provided
$ride_data = null;
if (isset($_GET['id'])) {
    $ride_id = $_GET['id'];
    $sql = "SELECT * FROM rides WHERE ride_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ride_data = $result->fetch_assoc();
    $stmt->close();
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora - Ride Management</title>
    <link rel="stylesheet" href="../manager/css/riders.css">
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