<?php
include "../settings/core.php";
include "../functions/select_staff_fxn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Booking Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        <?php include '../css/client_booking.css'; ?>
    </style>
</head>
<body>
    <div class="user-container">
        <?php
         // Check if the user_id session variable is set
         if (isset($_SESSION['user_id'])) {
            // Get the clientId from the session variable
            $clientId = $_SESSION['user_id'];
         }
        ?>
    </div>
    
    <div class="container">
        <h1>Book Appointment</h1>
        <form action="../actions/create_a_booking_action.php" method="post">
            <div class="form-group">
                <label for="staff"><i class="fas fa-user"></i></label>
                <select type="text" name="staff" id="selectstaff">
                    <option value="default">Select</option>
            <?php
              foreach ($staffresult as $selectstaff) {  
                echo "<option value=". $selectstaff['staffId']. ">" .$selectstaff['staff_fname'] . " " . $selectstaff['staff_lname'] ."</option>"; 
              }
              ?>
        </select>
            </div>
            <div class="form-group">
                <label for="service"><i class="fas fa-cogs"></i></label>
                <input type="text" placeholder="simple/in-depth description" id="service" name="service" pattern="^[a-zA-Z0-9\s.,'-]+$
" required>
            </div>
            <div class="form-group">
                <label for="date"><i class="far fa-calendar-alt"></i></label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="start-time"><i class="far fa-clock start-time"></i></label>
                <input type="time" placeholder="Start-time" id="start-time" name="start-time" required>
            </div>
            <div class="form-group">
                <label for="end-time"><i class="far fa-clock end-time"></i> </label>
                <input type="time" placeholder="End-Time" id="end-time" name="end-time" required>
            </div>
            <button type="submit" name="bookingbtn" id="bookingbtn" >Book Appointment</button>
            <button>
                <a href="../admin/client_access_booking.php">View Bookings</a>
            </button>

        </form>
    </div>
    <script>
    // Event listener for the booking button
    document.getElementById('bookingbtn').addEventListener('click', function(event) {
        var today = new Date(); // Get today's date
        var bookingDate = new Date(document.getElementById("date").value); // Get the selected booking date from the input field
        var minAllowedDate = new Date(); // Get a new instance of today's date
        minAllowedDate.setDate(today.getDate() + 2); // Set the minimum allowed date to today's date plus two days
        
        if (bookingDate < minAllowedDate) {
            // The selected booking date is less than two days in the future
            alert("Please select a booking date that is at least two days ahead from today.");
            // Prevent the form submission or handle the error as needed
            event.preventDefault(); // This line will prevent the form submission
        }
    });

    // Event listener for the start time input field
    document.getElementById('start-time').addEventListener('change', function(event) {
        var selectedTime = event.target.value;
        var selectedHours = parseInt(selectedTime.split(':')[0]); // Extract hours from selected time
        
        // Check if selected time is before 9 am
        if (selectedHours < 9) {
            alert("Please select a time from 9 am going.");
            event.target.value = ''; // Clear the input value
        }
    });

    // Event listener for the end time input field
    document.getElementById('end-time').addEventListener('change', function(event) {
        var selectedTime = event.target.value;
        var selectedHours = parseInt(selectedTime.split(':')[0]); // Extract hours from selected time
        
        // Check if selected time is after 9 pm
        if (selectedHours >= 21) { // 21 represents 9 pm in 24-hour format
            alert("Please select an end time before 21:00 pm because that is the salon's closing time.");
            event.target.value = ''; // Clear the input value
        }
    });
</script>
</body>
</html>
