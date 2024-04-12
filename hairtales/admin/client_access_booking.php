<?php
// Include necessary files
include "../settings/connection.php";
include "../settings/core.php";
include "../actions/get_all_specific_user_booking_action.php";
include "../functions/get_specific_booking_fxn.php";
include "../functions/get_user_fxn.php";

// Check if the session variable containing the client ID is set
if (isset($_SESSION['user_id'])) {
    // Get the client ID from the session variable
    $clientId = $_SESSION['user_id'];

    // Execute the function to retrieve specific bookings for the client
    $var_data = selectSpecificBookings($clientId, $conn);

    // Display bookings if any
    if (!empty($var_data)) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Client's Bookings</title>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <style>
                /* Add your CSS styling here or include an external CSS file */
                body {
                    font-family: 'Indie Flower', cursive;
                    font-size: 20px;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }

                .user-container {
                position: fixed;
                top: 0;
                right: 0;
                padding: 10px; /* Adjust padding as needed */
                background-color: #fff; /* Background color for better visibility */
                border: 1px solid #ccc; /* Border for better visibility */
                border-radius: 5px; /* Rounded corners for better appearance */
                z-index: 1000; /* Ensure the user container is above other content */
                }

                .fa-user-circle {
                color: black; /* Adjust color as needed */
                margin-right: 5px; /* Adjust margin as needed */
                }

                .user-name {
                color: black; /* Adjust color as needed */
                }

                .container {
                    max-width: 800px;
                    margin: 50px auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                    color: #333;
                }

                .booking {
                    border-bottom: 1px solid #ccc;
                    padding-bottom: 20px;
                    margin-bottom: 20px;
                    position: relative; /* Position relative for absolute positioning of delete icon */
                }

                .booking p {
                    margin: 0;
                }

                .client-name {
                    font-weight: bold;
                    color: #007bff;
                }

                .edit-icon {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    color: #ff0000; /* Red color for delete icon */
                    cursor: pointer;
                }

                button {
                    width: 99%; /* Adjust the width as needed */
                    height: 120%;
                    padding: 10px; /* Add padding to improve button appearance */
                    background-color: #9b5b22;
                    color: #fff;
                    border: none;
                    cursor: pointer;
                    border-radius: 10px;
                    margin-top: 30px;
                    margin-bottom: 10px;
                    transition: background-color 0.3s ease;
                }

                button:hover {
                    background-color: #3c2008;
                }
            </style>
        </head>
        <body>
        <div class="user-container">
        <i class="far fa-user-circle"></i>
        <span class="user-name"><?php echo getClientName($clientId, $conn); ?></span>
        <a href="../clients/client_logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
        
        <div class="container">
        <button type="button" name="createnewbooking" class="addbooking" id="newbookingbtn" onclick="window.location.href = '../admin/client_booking.php';">Create a booking</button>
            <h2>Bookings</h2>
            <?php
foreach ($var_data as $row) {
    echo "<div class='booking'>";
    echo "<p><span>Service:</span> " . $row["servicename"] . "</p>";
    echo "<p><span>Booking Date:</span> " . $row["booking_date"] . "</p>";
    echo "<p><span>Start Time:</span> " . $row["starttime_slot"] . "</p>";
    echo "<p><span>End Time:</span> " . $row["endtime_slot"] . "</p>";
    echo "<a href='../admin/client_edit_booking.php?bookingId=" . $row["bookingId"] . 
         "&service=" . urlencode($row["servicename"]) . 
         "&date=" . urlencode($row["booking_date"]) . 
         "&start-time=" . urlencode($row["starttime_slot"]) . 
         "&end-time=" . urlencode($row["endtime_slot"]) . "'><span class='edit-icon' style='cursor: pointer;'>&#9998;</span></a>";

    echo "</div>";
}
?>


        </div>

        </body>
        </html>
        <?php
    } else {
        // Display message if no bookings found
        echo "<p>No bookings found.</p>";
    }
} else {
    // Display an error message if the session variable is not set
    echo "Error: Client ID not set in session.";
}
?>
