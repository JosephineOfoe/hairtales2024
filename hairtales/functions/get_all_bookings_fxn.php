<?php
// Execute the function and assign the output to a variable named var_data
$var_data = selectBookingsForClient($clientId, $conn);

// Check if any bookings were returned
if (!empty($var_data)) {
    // Loop through the bookings and display them
    foreach ($var_data as $booking) {
        // Output booking details here
        echo "<p>Booking details: " . $booking['booking_details'] . "</p>";
    }
} else {
    // If no bookings were returned, display a message
    echo "No bookings found.";
}


?>