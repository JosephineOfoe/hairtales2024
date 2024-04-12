<?php
// Retrieve booking details from URL parameters
$bookingId = $_GET['bookingId'];
$service = urldecode($_GET['service']);
$date = urldecode($_GET['date']);
$startTime = urldecode($_GET['start-time']);
$endTime = urldecode($_GET['end-time']);
?>

<html>
    <body>
        <div>
            <!-- Populate form fields with booking details -->
<form action="../actions/edit_client_booking_action.php" method="get"> <!-- Change method to GET -->
    <input type="hidden" name="bookingId" value="<?php echo htmlspecialchars($bookingId); ?>">
    
    <label for="date">Booking Date:</label>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required><br><br>

    <button type="submit" id="updatebtn" name="updateBooking">Update Booking</button>
</form>
<script>
    // Event listener for the booking button
    document.getElementById('updatebtn').addEventListener('click', function(event) {
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
</script>
        </div>
    </body>
</html>
