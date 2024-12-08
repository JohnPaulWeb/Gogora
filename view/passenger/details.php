<?php
require_once('includes/db.php');

// Get the ride_id from the POST data
if (isset($_POST['ride_id'])) {
    $ride_id = $_POST['ride_id'];

    // Fetch ride details along with reservation details
    $query = "SELECT r.*, res.total_fare, res.payment_method, res.payment_status, res.status 
              FROM rides r 
              JOIN reservations res ON r.ride_id = res.ride_id 
              WHERE r.ride_id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("SQL prepare failed: " . $conn->error);
        echo "Sorry, something went wrong. Please try again later.";
        exit();
    }

    $stmt->bind_param('i', $ride_id);
    $stmt->execute();
    $ride_details = $stmt->get_result()->fetch_assoc();

    // Extract details to variables
    if ($ride_details) {
        $route = $ride_details['route'];
        $time = $ride_details['time'];
        $plate_number = $ride_details['plate_number'];
        $total_fare = $ride_details['total_fare'];
        $capacity = $ride_details['capacity'];
        $payment_method = $ride_details['payment_method'];
        $payment_status = $ride_details['payment_status'];
        $departure = $ride_details['departure'];  // Fetching departure from rides table
        $status = $ride_details['status']; // Fetching status from reservations table
    } else {
        echo "No ride found with the selected ID.";
        exit();
    }
} else {
    echo "No ride selected.";
    exit();
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <link rel="icon" type="image/png" href="assets/favicon.png"> 
    <link rel="stylesheet" href="styles.css">
</head>
<body id="details-bod">
    <div class="details-cont">
        <h1>Review Your Ride Details</h1>
        <div class="ride-details">
            <div class="detail-item">
                <span class="label">Plate No.:</span> 
                <span class="value"><?= htmlspecialchars($plate_number); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Departure:</span> 
                <span class="value"><?= date('g:i A', strtotime($departure)); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Capacity:</span> 
                <span class="value"><?= htmlspecialchars($capacity); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Status:</span> 
                <span class="value"><?= htmlspecialchars($status); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Route:</span> 
                <span class="value"><?= htmlspecialchars($route); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Total Fare:</span> 
                <span class="value">₱<?= htmlspecialchars($total_fare); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Payment Method:</span> 
                <span class="value"><?= htmlspecialchars($payment_method); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Payment Status:</span> 
                <span class="value"><?= htmlspecialchars($payment_status); ?></span>
            </div>

            <div class="button-section">
                <form action="confirmation.php" method="POST">
                    <input type="hidden" name="ride_id" value="<?= htmlspecialchars($ride_id); ?>">
                    <button type="submit" class="confirm-btn">Confirm</button>
                </form>
                <form action="booking.php" method="GET">
                    <button type="submit" class="cancel-btn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
