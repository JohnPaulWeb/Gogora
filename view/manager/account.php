<!-- <?php
   include ('../GoGora-main/control/includes.php');
  
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora - Manage Accounts</title>
    <link rel="stylesheet" href="../manager/css/account.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <div class="logo-image">Go</div>
                <h1>GoGora</h1>
            </div>
            <div class="nav-title">MANAGER</div>
            <ul>
                <li><a href="../manager/dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
                <li><a href="../manager/ride.php"><span class="icon">🚗</span> Ride Management</a></li>
                <li><a href="#"><span class="icon">👥</span> Passenger Management</a></li>
                <li><a href="../manager/route.php"><span class="icon">🛣️</span> Route Management</a></li>
                <li><a href="../manager/account.php"><span class="icon">👤</span> Account Management</a></li>
                <li><a href="../manager/prioritylane.php class="icon">⭐</span> Priority Lane Management</a></li>
                <li><a href="../manager/reservation.php"><span class="icon">📝</span> Reservations</a></li>
            </ul>
            <div class="logout">
                <a href="/control/includes/logout.php"><span class="icon">🚪</span> Logout</a>
            </div>
        </nav>
        <main class="content">
            <header>
                <h2>Manage Accounts</h2>
                <a href="#" class="back-link">Back to Dashboard</a>
            </header>
            <section class="accounts">
                <div class="section-header">
                    <h3>Accounts</h3>
                    <button class="add-user">Add User</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane Doe</td>
                            <td>janedoe</td>
                            <td>Passenger</td>
                            <td>Regular</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>johndoe</td>
                            <td>Passenger</td>
                            <td>Regular</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Juan Cruz</td>
                            <td>jcruz</td>
                            <td>Driver</td>
                            <td>Priority</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Anna Mae</td>
                            <td>maean</td>
                            <td>Admin</td>
                            <td>Priority</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Aiden Richards</td>
                            <td>aidenrich</td>
                            <td>Manager</td>
                            <td>Priority</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="blacklisted">
                <div class="section-header">
                    <h3>Blacklisted</h3>
                    <button class="add-user">Add User</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Reason</th>
                            <th>Blacklist Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Harry Roque</td>
                            <td>Did not follow terms and conditions</td>
                            <td>October 10, 2024</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Alice Guo</td>
                            <td>Keeps cancelling booking</td>
                            <td>October 14, 2024</td>
                            <td>
                                <button class="action-btn edit">✏️</button>
                                <button class="action-btn delete">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>