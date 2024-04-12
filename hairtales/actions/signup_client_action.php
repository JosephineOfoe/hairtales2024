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
        $sql = "INSERT INTO Clients (`rid`, `client_fname`, `client_lname`, `client_contact`, `client_email`, `client_passwd`, `client_dob`, `client_gender`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssss", $rid, $firstname, $lastname, $phonenumber, $emailaddress, $encrypt_password, $dateofbirth, $gender);

        // Explicitly set the value of $rid to 3
        $rid = 3;

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a confirmation page or profile page
            header("Location: ../clients/client_signin.php");
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
