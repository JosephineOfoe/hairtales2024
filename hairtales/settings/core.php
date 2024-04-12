<?php
// Start a PHP session
session_start();

// Function to check if the user ID session exists
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if user ID session doesn't exist
        header("Location: ../clients/client_signin.php");
        // Stop further execution
        die();
    }
}

// Call the function to check login status
checkLogin();

// Function to check if the user's role ID session exists
function getUserRoleId() {
    if (isset($_SESSION['rid'])) {
        // Return the user's role ID if the session exists
        return $_SESSION['rid'];
    } else {
        // Return false if the session doesn't exist
        return false;
    }
}

?>