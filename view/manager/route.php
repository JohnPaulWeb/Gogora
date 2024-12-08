
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Management - Manager</title>
    <link rel="stylesheet" href="../manager/css/route.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">GoGora</div>
            <a href="../manager/dashboard.php" class="menu-item active">Dashboard</a>
            <a href="../manager/ride.php" class="menu-item">Ride Management</a>
            <a href="#" class="menu-item">Route Management</a>
            <a href="../manager/account.php" class="menu-item">Account Management</a>
            <a href="../manager//prioritylane.php" class="menu-item">Priority Lane Management</a>
            <a href="../manager/reservation.php" class="menu-item">Reservations</a>
            <a href="/control/includes/logout.php" class="menu-item">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <form class="update-form" method="POST" action="process-update.php">
                <h2 class="form-title">UPDATE ROUTE</h2>
                
                <div class="form-group">
                    <label for="place_number">Place Number</label>
                    <input type="text" id="place_number" name="place_number" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bus_type">Type of Bus</label>
                        <select id="bus_type" name="bus_type" required>
                            <option value="">Select Type</option>
                            <option value="minibus">Minibus</option>
                            <option value="standard">Standard</option>
                            <option value="luxury">Luxury</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="seating_capacity">Seating Capacity</label>
                        <input type="number" id="seating_capacity" name="seating_capacity" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="destination_to">Destination To</label>
                        <input type="text" id="destination_to" name="destination_to" required>
                    </div>
                    <div class="form-group">
                        <label for="destination_from">Destination From</label>
                        <input type="text" id="destination_from" name="destination_from" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="schedule_time">Schedule Time</label>
                        <select id="schedule_time" name="schedule_time" required>
                            <option value="">Select Time</option>
                            <?php
                            for ($hour = 0; $hour < 24; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 30) {
                                    $time = sprintf("%02d:%02d", $hour, $minute);
                                    echo "<option value='$time'>$time</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="arrival_time">Arrival Time</label>
                        <select id="arrival_time" name="arrival_time" required>
                            <option value="">Select Time</option>
                            <?php
                            for ($hour = 0; $hour < 24; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 30) {
                                    $time = sprintf("%02d:%02d", $hour, $minute);
                                    echo "<option value='$time'>$time</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-update">UPDATE</button>
                    <button type="button" class="btn btn-back" onclick="history.back()">BACK</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>