<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora Dashboard</title>
    <link rel="stylesheet" href="../manager/css/dashboard.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="GoGora Logo">
                <h1>GoGora</h1>
            </div>
            <div class="manager-label">MANAGER</div>
            <nav>
                <ul>
                    <li><a href="#" class="active"><img src="dashboard-icon.png" alt="">Dashboard</a></li>
                    <li><a href="../manager/ride.php"><img src="ride-icon.png" alt="">Ride Management</a></li>
                    <li><a href="#"><img src="route-icon.png" alt="">Route Management</a></li>
                    <li><a href="#"><img src="account-icon.png" alt="">Account Management</a></li>
                    <li><a href="#"><img src="stats-icon.png" alt="">Statistics & Report</a></li>
                    <li><a href="#"><img src="priority-icon.png" alt="">Priority Lane Management</a></li>
                    <li><a href="#"><img src="reservations-icon.png" alt="">Reservations</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php"><img src="logout-icon.png" alt="">Logout</a>
            </div>
        </aside>

        <main class="content">
            <div class="header">
                <h1>Dashboard</h1>
                <a href="#" class="back-link">Back to Dashboard</a>
            </div>

            <div class="bookings-container">
                <div class="bookings-header">
                    <h2>Bookings</h2>
                    <div class="search-bar">
                        <label for="search">Search:</label>
                        <input type="text" id="search" name="search">
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Passenger</th>
                                <th>Plate No.</th>
                                <th>Type</th>
                                <th>Destination</th>
                                <th>Schedule</th>
                                <th>Seats</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php
                            // Database connection
                            $conn = new mysqli('localhost', 'username', 'password', 'gogora_db');
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT * FROM bookings ORDER BY schedule ASC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['passenger_name']}</td>
                                        <td>{$row['plate_no']}</td>
                                        <td>{$row['type']}</td>
                                        <td>{$row['destination']}</td>
                                        <td>{$row['schedule']}</td>
                                        <td>{$row['seats']}</td>
                                        <td><span class='status {$row['status']}'>{$row['status']}</span></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No bookings found</td></tr>";
                            }
                            $conn->close();
                            ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>