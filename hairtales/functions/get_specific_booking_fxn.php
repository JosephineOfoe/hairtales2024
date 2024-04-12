<?php
// Include the function file
include "../settings/connection.php";

// Check if the client ID is set in the session
if (isset($_SESSION['user_id'])) {
    // Get the client ID from the session
    $clientId = $_SESSION['user_id'];

    // Execute the function and assign the output to a variable named var_data
    $var_data = selectSpecificBookings($clientId, $conn);

    // Check if any bookings were returned
    if (!empty($var_data)) {
        // Display bookings
    } else {
        // If no bookings were returned, display a message
        echo "No bookings found.";
    }
} else {
    // If the client ID is not set in the session, display an error message
    echo "Error: Client ID not set in session.";
}
?>
