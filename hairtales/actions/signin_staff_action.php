<?php
session_start(); // Start the session
include "../settings/connection.php";

if (isset($_POST['signinbtn'])) { // Change to 'signinbtn' if that's your login button name
    $emailaddress = $_POST['emailaddress'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement to prevent SQL injection
    $sql = "SELECT staffId, rid, staff_passwd FROM Staffs WHERE staff_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailaddress);

    // Execute the statement
    if ($stmt->execute()) {
        // Bind the result variables
        $stmt->bind_result($staffId, $rid, $staff_passwd);

        // Fetch the result
        if ($stmt->fetch()) {
            // Verify the password
            if (password_verify($password, $staff_passwd)) {
                // Password is correct, user is authenticated
                $_SESSION['user_id'] = $staffId;
                $_SESSION['role_id'] = $rid;
                
                $_SESSION['email'] = $emailaddress; // Store email in session for future use if needed
                
                // Redirect based on role ID
                if ($rid == 1) {
                    // Redirect for role 1
                    header("Location: ../view/all_bookings.php");
                    exit();
                } elseif ($rid == 2) {
                    // Redirect for role 2
                    header("Location: ../admin/staff_access_booking.php");
                    exit();
                } else {
                    // Handle other roles if necessary
                }
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
