<?php
//Connect to database and create table
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "main_parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
    "<a href='install.php'>If first time running click here to install database</a>";
}

// Handle:Execute SQL query View data Begin
$sql = "SELECT * FROM main_table ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$data = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
echo json_encode($data);
// Handle: Display query result End
?>