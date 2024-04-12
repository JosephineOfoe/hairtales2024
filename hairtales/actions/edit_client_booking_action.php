<?php

// Include necessary files
include "../settings/connection.php";

// Check if the bookingId is set in the URL parameters
if(isset($_GET['bookingId'])) {
    // Get the bookingId from the URL
    $bookingId = $_GET['bookingId'];

    // Fetch the booking details from the database based on the bookingId
    $sql = "SELECT * FROM Bookings WHERE bookingId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the booking exists
    if($result->num_rows > 0) {
        // Fetch the booking details
        $booking = $result->fetch_assoc();

        // Assuming form inputs are named 'service', 'date', 'start-time', and 'end-time'
        // Capture the updated values from the form
        $service = $_GET['service'] ?? '';
        $date = $_GET['date'] ?? '';
        $startTime = $_GET['start-time'] ?? '';
        $endTime = $_GET['end-time'] ?? ''; 


        // Initialize an array to hold the parameters for binding
        $parameters = array();
        
        if (!empty($date)) {
            $updateDateSql = "UPDATE Bookings SET booking_date = ? WHERE bookingId = ?";
            $stmt = $conn->prepare($updateDateSql);
            $stmt->bind_param("si", $date, $bookingId);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                // Redirect to a success page
                header("Location: ../admin/client_access_booking.php");
                exit; // Stop further execution
            } else {
                echo "Error updating date: " . $conn->error . "<br>";
            }
        }
       
    } else {
        // If the booking does not exist, you can handle the error here
        // For example, you can redirect the user to an error page or display an error message
        echo "Error: Booking not found.";
    }
} else {
    // If the bookingId is not set in the URL parameters, you can handle the error here
    // For example, you can redirect the user to an error page or display an error message
    echo "Error: Booking ID not provided.";
}
?>
