<?php
function selectSpecificBookings($clientId, $conn) {
    include "../settings/connection.php";
    // Prepare the SQL statement using a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM Bookings WHERE clientId = ?";
    $stmt = $conn->prepare($sql);

    // Bind the client ID parameter
    $stmt->bind_param("i", $clientId);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Initialize an array to store the bookings
        $bookings = array();

        // Fetch each row from the result set and store it in the array
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Return the array of bookings
        return $bookings;
    } else {
        // If no bookings found, return null or an empty array as per your requirement
        return null;
    }
}

?>
