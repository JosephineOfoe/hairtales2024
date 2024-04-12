<?php
// Include the connection file
include "../settings/connection.php";

// Define a function to fetch bookings for a specific client
function selectBookingsForClient($clientId, $conn) {
    // Define the SELECT query to fetch bookings for the specified client
    $sql = "SELECT * FROM Bookings WHERE clientId = ?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the client ID parameter
    $bindResult = $stmt->bind_param("i", $clientId);
    if (!$bindResult) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the query
    $executeResult = $stmt->execute();
    if (!$executeResult) {
        die("Error executing query: " . $stmt->error);
    }

    // Get the result set
    $result = $stmt->get_result();

    // Fetch records and assign to a variable
    $bookings = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement
    $stmt->close();

    // Return the bookings
    return $bookings;
}

// Function to get client name
function getClientName($clientId, $conn) {
    // Define the SELECT query to fetch the client name
    $sql = "SELECT CONCAT(client_fname, ' ', client_lname) AS client_name FROM Clients WHERE clientId = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the client ID parameter
    $bindResult = $stmt->bind_param("i", $clientId);
    if (!$bindResult) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute the query
    $executeResult = $stmt->execute();
    if (!$executeResult) {
        die("Error executing query: " . $stmt->error);
    }

    // Get the result set
    $result = $stmt->get_result();

    // Fetch client name
    $row = $result->fetch_assoc();
    $clientName = $row['client_name'];

    // Close the statement
    $stmt->close();

    // Return the client name
    return $clientName;
}

// Fetch all distinct client IDs from the database
$sql = "SELECT DISTINCT clientId FROM Bookings";
$result = $conn->query($sql);

// Check if execution was successful
if ($result === FALSE) {
    die("Error executing query: " . $conn->error);
}

// Initialize an array to store client IDs and their respective bookings
$clientBookings = [];

// Loop through each client ID and fetch their bookings
while ($row = $result->fetch_assoc()) {
    // Get the client ID
    $clientId = $row['clientId'];

    // Call the function to retrieve bookings for the current client
    $bookings = selectBookingsForClient($clientId, $conn);

    // Get the client name
    $clientName = getClientName($clientId, $conn);

    // Store client name and bookings in the array
    $clientBookings[] = [
        'clientId' => $clientId,
        'clientName' => $clientName,
        'bookings' => $bookings
    ];
}

// Close the result set
$result->close();

// Close the database connection
$conn->close();

?>
