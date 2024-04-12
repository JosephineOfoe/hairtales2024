<?php

// Include the database connection file
include "../settings/connection.php";

function getStaffName($staffId, $conn) {
    // Check if staffId is provided
    if (!$staffId) {
        return "Staff ID is not provided.";
    }

    // Check if the database connection is valid
    if (!($conn instanceof mysqli)) {
        return "Database connection is not valid.";
    }

    // Prepare the SELECT query to fetch the staff name
    $sql = "SELECT CONCAT(staff_fname, ' ', staff_lname) AS staff_name FROM Staffs WHERE staffId = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Check for errors in preparing the statement
    if (!$stmt) {
        return "Error in preparing statement: " . $conn->error;
    }

    // Bind the staff ID parameter
    $stmt->bind_param("i", $staffId);

    // Execute the query
    if (!$stmt->execute()) {
        return "Error in executing statement: " . $stmt->error;
    }

    // Get the result set
    $result = $stmt->get_result();

    // Fetch staff name
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $staffName = $row['staff_name'];
    } else {
        $staffName = "Staff not found.";
    }

    // Close the statement
    $stmt->close();

    // Return the staff name
    return $staffName;
}
?>
