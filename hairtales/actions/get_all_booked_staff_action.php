<?php
function getAllBookedStaff() {
    global $conn; // Assuming $conn is your database connection object
    
    // Check if the session variable containing the staff ID is set
    if (isset($_SESSION['user_id'])) {
        // Get the staff ID from the session variable
        $staffId = $_SESSION['user_id'];

        // Select bookings for the specific staff
$getBookingsQuery = "SELECT Clients.clientId, CONCAT(Clients.client_fname, ' ', Clients.client_lname) AS clientName, Bookings.bookingId, Bookings.servicename, Bookings.booking_date, Bookings.starttime_slot, Bookings.endtime_slot
FROM Clients
INNER JOIN Bookings ON Clients.clientId = Bookings.clientId
WHERE Bookings.staffId = ?";


        // Prepare and bind the query
        $stmt = $conn->prepare($getBookingsQuery);
        
        if (!$stmt) {
            // Error handling for query preparation
            echo "Error preparing statement: " . $conn->error;
            return false; // Exit function
        }

        $stmt->bind_param("i", $staffId);

        // Execute the query
        if ($stmt->execute()) {
            // Bind the result variables
            $stmt->bind_result($clientId, $clientName, $bookingId, $serviceName, $bookingDate, $startTime, $endTime);

            // Initialize an array to store client bookings
            $clientBookings = array();

            // Loop through the result set
            while ($stmt->fetch()) {
                // Check if client exists in the array, if not add them
                if (!isset($clientBookings[$clientId])) {
                    $clientBookings[$clientId] = array(
                        'clientName' => $clientName,
                        'bookings' => array()
                    );
                }

                // Add booking details to the client's bookings array
                $clientBookings[$clientId]['bookings'][] = array(
                    'bookingId' => $bookingId,
                    'servicename' => $serviceName,
                    'booking_date' => $bookingDate,
                    'starttime_slot' => $startTime,
                    'endtime_slot' => $endTime
                );
            }

            // Close the statement
            $stmt->close();

            // Return the array of client bookings
            return $clientBookings;
        } else {
            // Error executing the query
            echo "Error executing query: " . $stmt->error;
            return false; // Exit function
        }
    } else {
        // If the session variable is not set, handle the error accordingly
        echo "Staff ID is not provided.";
        return false; // Exit function
    }
}

?>