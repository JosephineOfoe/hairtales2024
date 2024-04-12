<?php
function getClientName($clientId, $conn) {
    // Define the SELECT query to fetch the client name
    $sql = "SELECT CONCAT(client_fname, ' ', client_lname) AS client_name FROM Clients WHERE clientId = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the client ID parameter
    $stmt->bind_param("i", $clientId);

    // Execute the query
    $stmt->execute();

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

?>
