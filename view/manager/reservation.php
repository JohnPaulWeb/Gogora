<?php
 $server = "localhost";
 $username = "root";
 $password = "";
 $database = "gogora_db";
 
 $conn = new mysqli($server, $username, $password, $database);
 
 if ($conn->connect_error) {
     die("Connection Failed: " . $conn->connect_error);


     function getAllReservations() {
        global $conn;
        $sql = "SELECT r.*, rides.route, rides.time as schedule 
                FROM reservations r 
                JOIN rides ON r.ride_id = rides.ride_id 
                ORDER BY r.reservation_time DESC";
        $result = $conn->query($sql);
        $reservations = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reservations[] = $row;
            }
        }
        
        return $reservations;
    }
    
    // Get available rides
    function getAvailableRides() {
        global $conn;
        $sql = "SELECT * FROM rides 
                WHERE seats_available > 0 
                AND time > NOW() 
                ORDER BY time";
        $result = $conn->query($sql);
        $rides = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rides[] = $row;
            }
        }
        
        return $rides;
    }
    
    // Create new reservation
    function createReservation($user_id, $ride_id, $total_fare, $payment_method) {
        global $conn;
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Check seat availability
            $sql = "SELECT seats_available FROM rides WHERE ride_id = ? FOR UPDATE";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ride_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $ride = $result->fetch_assoc();
            
            if ($ride['seats_available'] <= 0) {
                throw new Exception("No seats available");
            }
            
            // Create reservation
            $sql = "INSERT INTO reservations 
                    (user_id, ride_id, reservation_time, status, payment_status, total_fare, payment_method) 
                    VALUES (?, ?, NOW(), 'pending', 'unpaid', ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iids", $user_id, $ride_id, $total_fare, $payment_method);
            $stmt->execute();
            
            // Update seats available
            $sql = "UPDATE rides SET seats_available = seats_available - 1 WHERE ride_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ride_id);
            $stmt->execute();
            
            // Commit transaction
            $conn->commit();
            return ['success' => true, 'reservation_id' => $conn->insert_id];
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    // Update reservation status
    function updateReservationStatus($reservation_id, $status) {
        global $conn;
        
        $sql = "UPDATE reservations SET status = ? WHERE reservation_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $reservation_id);
        
        return $stmt->execute();
    }
    
    // Update payment status
    function updatePaymentStatus($reservation_id, $payment_status) {
        global $conn;
        
        $sql = "UPDATE reservations SET payment_status = ? WHERE reservation_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $payment_status, $reservation_id);
        
        return $stmt->execute();
    }
    
    // Cancel reservation
    function cancelReservation($reservation_id) {
        global $conn;
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Get ride_id from reservation
            $sql = "SELECT ride_id FROM reservations WHERE reservation_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $reservation_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $reservation = $result->fetch_assoc();
            
            // Update reservation status
            $sql = "UPDATE reservations SET status = 'cancelled' WHERE reservation_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $reservation_id);
            $stmt->execute();
            
            // Increase available seats
            $sql = "UPDATE rides SET seats_available = seats_available + 1 WHERE ride_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $reservation['ride_id']);
            $stmt->execute();
            
            // Commit transaction
            $conn->commit();
            return true;
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            return false;
        }
    }
    
    // API endpoint handler
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $action = $_GET['action'] ?? '';
        
        switch($action) {
            case 'create':
                $response = createReservation(
                    $data['user_id'],
                    $data['ride_id'],
                    $data['total_fare'],
                    $data['payment_method']
                );
                echo json_encode($response);
                break;
                
            case 'update_status':
                $response = updateReservationStatus(
                    $data['reservation_id'],
                    $data['status']
                );
                echo json_encode(['success' => $response]);
                break;
                
            case 'update_payment':
                $response = updatePaymentStatus(
                    $data['reservation_id'],
                    $data['payment_status']
                );
                echo json_encode(['success' => $response]);
                break;
                
            case 'cancel':
                $response = cancelReservation($data['reservation_id']);
                echo json_encode(['success' => $response]);
                break;
                
            default:
                echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'] ?? 'reservations';
        
        switch($action) {
            case 'available_rides':
                $rides = getAvailableRides();
                echo json_encode(['success' => true, 'data' => $rides]);
                break;
                
            default:
                $reservations = getAllReservations();
                echo json_encode(['success' => true, 'data' => $reservations]);
        }
    }
    
    $conn->close();
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGora - Manager Dashboard</title>
    <link rel="stylesheet" href="../manager/css/reservation.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">GoGora</div>
            <div class="nav-item active" a href="../manager/dashboard.php">Dashboard</div>
            <div class="nav-item" a href="../manager/rides.php">Ride Management</div>
            <div class="nav-item">Passenger Management</div>
            <div class="nav-item">Route Management</div>
            <div class="nav-item">Account Management</div>
            <div class="nav-item">Priority Lane Management</div>
            <div class="nav-item">Reservations</div>
        </div>
        
        <div class="main-content">
            <div class="panel">
                <h2 class="panel-title">Reservations Management</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Route</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="panel">
                <h2 class="panel-title">Available Rides</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Ride ID</th>
                            <th>Route</th>
                            <th>Schedule</th>
                            <th>Seats Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>