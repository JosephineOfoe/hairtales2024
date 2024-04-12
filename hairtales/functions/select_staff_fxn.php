<?php
// include the connection file
include_once "../settings/connection.php";

$displaystaff = "SELECT * FROM Staffs";

// Execute the SQL query
$staffresult = $conn->query($displaystaff);
return mysqli_fetch_all($staffresult);

?>