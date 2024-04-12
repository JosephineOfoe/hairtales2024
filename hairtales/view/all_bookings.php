<?php
include "../settings/core.php";
include "../actions/get_all_bookings_action.php";
include "../functions/get_staff_fxn.php";

// Check if the session variable containing the staff ID is set
if (isset($_SESSION['user_id'])) {
    // Get the staff ID from the session variable
    $staffId = $_SESSION['user_id'];

    // Call the getStaffName function with $staffId
    //echo "<span class='user-name'>" . getStaffName($staffId, $conn) . "</span>";
} else {
    // If the session variable is not set, handle the error accordingly
    echo "Staff ID is not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Owners' View of Bookings</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       <?php include '../css/all_bookings.css'; ?>
    </style>
</head>
<body>
    <div class="user-container">
        <i class="far fa-user-circle"></i>
        <span class="user-name"><?php echo getStaffName($staffId, $conn); ?></span>
        <a href="../staffs/staff_logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
<div class="container">
    <h2>Bookings</h2>
    <?php
    // Loop through each client and their bookings
    foreach ($clientBookings as $clientData) {
        $clientId = $clientData['clientId'];
        $clientName = $clientData['clientName'];
        $bookings = $clientData['bookings'];

        // Display client name for each booking group
        foreach ($bookings as $booking) {
            // Output booking details here
            echo "<div class='booking'>";
            echo "<p><span class='client-name'>Client Name:</span> $clientName</p>";
            echo "<p><span>Service:</span> " . $booking['servicename'] . "</p>";
            echo "<p><span>Booking Date:</span> " . $booking['booking_date'] . "</p>";
            echo "<p><span>Start Time:</span> " . $booking['starttime_slot'] . "</p>";
            echo "<p><span>End Time:</span> " . $booking['endtime_slot'] . "</p>";
            echo "<a href='../actions/delete_booking_action.php?bookingId=" . $booking['bookingId'] . "'>";
            echo "<span class='delete-icon'>&#128465;</span></a>";
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>