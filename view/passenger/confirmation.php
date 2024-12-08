<?php
require_once('includes/db.php');

// Capture ride_id from POST data
$ride_id = $_POST['ride_id'] ?? '';

// Initialize variables for ride and reservation details
$route = '';
$time = '';
$seats_available = '';
$ride_type = '';
$plate_number = '';
$total_fare = '';
$capacity = '';
$status = '';
$payment_status = '';
$payment_method = '';
$departure = '';
$queue = '';

// Fetch ride and reservation details from the database
if ($ride_id) {
    $sql = "
        SELECT r.route, r.time, r.seats_available, r.ride_type, r.plate_number, r.capacity, r.departure, r.queue,
               res.status, res.payment_status, res.`total_fare` AS total_fare, res.`payment_method` AS payment_method
        FROM rides AS r
        JOIN reservations AS res ON r.ride_id = res.ride_id
        WHERE r.ride_id = ?
    ";
    $stmt = $conn->prepare($sql);
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        echo "SQL preparation error: " . $conn->error;
        exit();
    }

    $stmt->bind_param("i", $ride_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if ride and reservation details were found
    if ($result->num_rows > 0) {
        $details = $result->fetch_assoc();
        
        // Assign the retrieved values to variables
        $route = $details['route'];
        $time = $details['time'];
        $seats_available = $details['seats_available'];
        $ride_type = $details['ride_type'];
        $plate_number = $details['plate_number'];
        $capacity = $details['capacity'];
        $departure = $details['departure'];
        $status = $details['status'];
        $payment_status = $details['payment_status'];
        $total_fare = $details['total_fare'];
        $payment_method = $details['payment_method'];
        $queue = $details['queue'];
    } else {
        echo "No ride or reservation details found for the selected ride.";
        exit();
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="icon" type="image/png" href="assets/favicon.png"> 
    <link rel="stylesheet" href="styles.css">
</head>
<body id="confirm-bod">
    <div class="confirm-cont">
        <h1>Booking Confirmed!</h1>
        <img src="assets/confirm.png" alt="Confirmation">
        <span class="label">Thank you for booking! Your queue number is:</span> <span class="value"><?= htmlspecialchars($queue); ?></span>
        <p>Please be ready at your pickup location. You are currently no. <span class="value"><?= htmlspecialchars($queue); ?></span> in queue.</p>

        <div class="ride-details">
            <h1>Ride Details</h1>
            <div class="detail-item">
                <span class="label">Plate No.:</span> <span class="value"><?= htmlspecialchars($plate_number); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Departure:</span> <span class="value"><?= date('g:i A', strtotime($departure)); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Capacity:</span> <span class="value"><?= htmlspecialchars($capacity); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Status:</span> <span class="value"><?= htmlspecialchars($status); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Route:</span> <span class="value"><?= htmlspecialchars($route); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Total Fare:</span> <span class="value">₱<?= htmlspecialchars($total_fare); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Payment Method:</span> <span class="value"><?= htmlspecialchars($payment_method); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Payment Status:</span> <span class="value"><?= htmlspecialchars($payment_status); ?></span>
            </div>
        </div>
        <button type="button" class="confirm-btn" onclick="window.location.href='booking.php'">Return to Home</button>
    </div>
</body>
</html>
