<?php
include "../settings/connection.php";

if (!isset($_GET['bookingId'])) {
    // Redirect to chore_control_view.php if bookingId is not provided
    header("Location: ../admin/staff_access_booking.php");
    exit(); // Ensure that script execution stops after redirection
}

// Retrieve ID from the GET URL and store it in a variable
$id = $_GET['bookingId'];

// Write your delete query using the variable
$sql = "DELETE FROM Bookings WHERE bookingId = $id";

// Execute the query using the connection from the connection file
$result = mysqli_query($conn, $sql);

// Check if execution worked
if ($result) {
    // Redirect to chore_control_view.php if execution is successful
    header("Location: ../admin/staff_access_booking.php");
    exit(); // Make sure to stop the script execution after redirection
} else {
    // Display error on assign_chore_view page if execution fails
    echo "Error: " . mysqli_error($conn);
}
?>
