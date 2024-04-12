<?php
include "../settings/connection.php";
include "../settings/core.php";

if (isset($_POST['bookingbtn'])) {
    $staffname = $_POST['staff'];
    $clientId = $_SESSION['user_id'];
    $service = $_POST['service'];
    $bookdate = $_POST['date'];
    $starttime = $_POST['start-time'];
    $endtime = $_POST['end-time'];

    // Prepare and bind SQL statement to prevent SQL injection
    $sql = "INSERT INTO Bookings (`staffId`, `clientId`, `servicename`, `current_date`, `booking_date`, `starttime_slot`, `endtime_slot`) 
            VALUES (?, ?, ?, CURRENT_DATE(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $staffname, $clientId, $service, $bookdate, $starttime, $endtime);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to a confirmation page or profile page
        header("Location: ../admin/client_access_booking.php");
        exit();
    } else {
        // Handle any errors during execution
        echo "Error: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
