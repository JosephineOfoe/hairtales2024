<?php
// Check if constants are not defined before defining them
if (!defined('HOST')) {
    define("HOST", "localhost");
}
if (!defined('DB_NAME')) {
    define("DB_NAME", "hairtales");
}
if (!defined('USERNAME')) {
    define("USERNAME", "root");
}
if (!defined('PASSWORD')) {
    define("PASSWORD", "");
}

$conn = new mysqli(HOST, USERNAME, PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>