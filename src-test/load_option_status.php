<?php
include_once "../src/utils/db_connection.php";
$sql = "SELECT * FROM `status_code` WHERE 1";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Tạo bảng HTML
if (mysqli_num_rows($result) > 0) {
    echo '<option value="0">All</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo ' <option value="' . $row["sId"] . '">' .  $row["description"] . '</option>';
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

mysqli_close($conn);
