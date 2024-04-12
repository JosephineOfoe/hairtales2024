<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-GmPzYwpdNa4tT5mCkUO2o4gKjOzgFSIQfG7qs6P4E5QUoRQ1wGj3oJh5bKxRR8lY" crossorigin="anonymous">
    <style>
        <?php include 'css/index.css'; ?>
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="header/about_us.php">About Us</a></li>
                <li><a href="header/services.php">Services</a></li>
                <li><a href="header/contact_us.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="welcome-container">
        <h1>Welcome to HAIRTALES</h1>
        <div class="role-buttons">
            <!-- Hidden field for indicating role -->
            <input type="hidden" name="role" value="client">
            <a href="clients/client_signup.php"><button id="client-signup-btn">CLIENT</button></a>
            <!-- Hidden field for indicating role -->
            <input type="hidden" name="role" value="client">
            <a href="staffs/staff_signup.php"><button id="staff-signup-btn">STAFF</button></a>
        </div>
    </div>
</body>
</html>
