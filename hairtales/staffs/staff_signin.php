<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staffs' SignIn</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        <?php include '../css/staff_signin.css'; ?>
    </style>
</head>
<body>
<div class="staff-container">
    <div class="form-container">
        <h2>Sign In</h2>
        <form action="../actions/signin_staff_action.php" method="post" name="signinform" id="signin">
            <div class="entries">
                <label for="email"><i class="fas fa-envelope"></i></label>
                <input placeholder="Email" type="email" name="emailaddress" id="emailaddress" pattern="[a-z._%+\-]+@[a-z.\-]+\.[a-z]{2,}$" required>
                <label for="password"></label><a href="..staffs/staff_logout.php" id="fgp">Forgot Password?</a>
                <label for="password"><i class="fas fa-lock"></i></label>
                <input placeholder="Password" type="password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}" required>
                <!-- Hidden field for indicating role -->
                <input type="hidden" name="role" value="client">
                <button type="submit" name="signinbtn" id="signin">Sign In</button>
                <p>Don't have an account? <a href="../staffs/staff_signup.php">Sign Up</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>