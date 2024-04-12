<?php
include "../settings/connection.php";

if (isset($_POST['signupbtn'])) {
    $firstname = $_POST["first_name"];
    $lastname = $_POST['last_name'];
    $phonenumber = $_POST['phonenumber'];
    $emailaddress = $_POST['emailaddress'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dateofbirth = $_POST['dob'];
    $gender = $_POST['gender'];

    if ($password !== $confirm_password) {
        // Passwords do not match, handle the error (for example, display an error message)
        echo "Passwords do not match.";
    } else {
        $encrypt_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare and bind SQL statement to prevent SQL injection
        $sql = "INSERT INTO Staffs (`rid`, `staff_fname`, `staff_lname`, `staff_contact`, `staff_email`, `staff_passwd`, `staff_dob`, `staff_gender`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssss", $rid, $firstname, $lastname, $phonenumber, $emailaddress, $encrypt_password, $dateofbirth, $gender);

        // Set the value of $rid based on your condition
        if ($some_condition) {
            $rid = 1; // Redirect to one page
        } else {
            $rid = 2; // Redirect to another page
        }

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect based on $rid
            if ($rid == 1) {
                header("Location: ../admin/dashboard.php");
            } elseif ($rid == 2) {
                header("Location: ../admin/client_booking.php");
            }
            exit();
        } else {
            // Handle any errors during execution
            echo "Error: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
