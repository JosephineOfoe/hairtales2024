<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients' SignUp</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        <?php include '../css/client_signup.css'; ?>
    </style>
</head>
<body>
<div class="client-container">
    <div class="form-container">
        <h2>Sign Up</h2>
        <form action="../actions/signup_client_action.php" method="post" name="signupform" id="signup">
            <div class="entries">
                <label for="fname"><i class="fas fa-user"></i></label>
                <input placeholder="First Name" type="fname" name="first_name" id="fname" pattern="^[A-Za-z\-]+$" required>
                <label for="lname"><i class="fas fa-user-alt"></i></label>
                <input placeholder="Last Name" type="lname" name="last_name" id="lname" pattern="^[A-Za-z\-]+$" required>
                <label for="phone"><i class="fas fa-phone"></i></label>
                <input type="tel" id="phone" name="phonenumber" placeholder="Phone Number" pattern="0\d{9}" required>
                <label for="email"><i class="fas fa-envelope"></i></label>
                <input placeholder="Email" type="email" name="emailaddress" id="emailaddress" pattern="[a-z._%+\-]+@[a-z.\-]+\.[a-z]{2,}$" required>
                <label for="password"><i class="fas fa-lock"></i></label>
                <input placeholder="Password" type="password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}" required>
                <label for="confirm_password"><i class="fas fa-lock confirm"></i></label>
                <input placeholder="Confirm Password" type="password" name="confirm_password" id="confirm_password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}" required>
                <label for="dob"><i class="fas fa-calendar"></i> Date of Birth</label>
                <input type="date" id="dob" name="dob" class="DoB" placeholder="YYYY-MM-DD" required>
                
                <div class="gender-container">
                    <label for="gender" id="gen">Gender ?</label>
                    <label for="0-Male" class="male">Male</label>
                    <input type="radio" name="gender" id="male" value="0" required>
                    <label for="1-Female" class="female">Female</label>
                    <input type="radio" name="gender" id="female" value="1" required>
                </div>
                <!-- Hidden field for indicating role -->
                <input type="hidden" name="role" value="client">
                <button type="submit" name="signupbtn" id="signupbtn">Sign Up as a Client</button>
                <p>Already have an account? <a href="../clients/client_signin.php">Sign In</a></p>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('signupbtn').addEventListener('click', function(event) {
    var today = new Date(); // Get today's date
    var inputDate = new Date(document.getElementById("dob").value); // Get the selected date from the input field
    if (inputDate > today) {
        // The selected date is in the future
        alert("Please select a date that is not in the future.");
        // Prevent the form submission or handle the error as needed
        event.preventDefault(); // This line will prevent the form submission
    }
});
</script>
</body>
</html>