<?php
session_start(); // Start the session
include "../settings/connection.php";

if (isset($_POST['signinbtn'])) { // Change to 'signinbtn' if that's your login button name
    $emailaddress = $_POST['emailaddress'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement to prevent SQL injection
    $sql = "SELECT clientId, rid, client_passwd FROM Clients WHERE client_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailaddress);

    // Execute the statement
    if ($stmt->execute()) {
        // Bind the result variables
        $stmt->bind_result($clientId, $rid, $client_passwd);

        // Fetch the result
        if ($stmt->fetch()) {
            // Verify the password
            if (password_verify($password, $client_passwd)) {
                // Password is correct, user is authenticated
                // Create session variables
                $_SESSION['user_id'] = $clientId;
                $_SESSION['role_id'] = $rid;
                $_SESSION['email'] = $emailaddress; // Store email in session for future use if needed

                // Redirect to the user's profile page or any other authenticated page
                header("Location: ../admin/client_booking.php");
                exit();
            } else {
                // Incorrect password
                echo "Incorrect email or password.";
            }
        } else {
            // User with the provided email address not found
            echo "Incorrect email or password.";
        }
    } else {
        // Error executing the statement
        echo "Error: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

?>