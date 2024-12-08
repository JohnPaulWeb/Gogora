
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Priority Lane Management - Manager</title>
    <link rel="stylesheet" href="../manager/css/prioritylane.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="../admin//assets/assets/logo.png" alt="GoCora">
            </div>
            <nav>
                <ul>
                    <li><a href="../manager//dashboard.php"><span>Dashboard</span></a></li>
                    <li><a href="../manager/ride.php"><span>Ride Management</span></a></li>
                    <li><a href="#"><span>Passenger Management</span></a></li>
                    <li><a href="../manager/route.php"><span>Route Management</span></a></li>
                    <li><a href="#"><span>Account Management</span></a></li>
                    <li class="active"><a href="#"><span>Priority Lane Management</span></a></li>
                    <li><a href="#"><span>Reservations</span></a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="#"><span>Logout</span></a>
            </div>
        </aside>
        
        <main class="content">
            <h1>Priority Lane Management</h1>
            
            <section class="priority-users">
                <h2>Priority User Management</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Passenger</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php include 'fetch_users.php'; ?> -->
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="ride-management">
                <h2>Ride Management</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Route</th>
                                <th>Schedule</th>
                                <th>Seats</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php include 'fetch_rides.php'; ?> -->
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>