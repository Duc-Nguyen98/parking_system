<?php
include_once "../src/utils/db_connection.php";
include_once "../src/utils/parking_functions.php";
$sql = "SELECT DISTINCT idParkArena FROM parking_arena ORDER BY idParkArena ASC;";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Tạo bảng HTML
if (mysqli_num_rows($result) > 0) {
    echo '<option value="0">All</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $parkArenaInfo = getParkArenaStatus($row["idParkArena"]);
        $rParkArena = $parkArenaInfo["idParkArena"];
        $rClassArena = $parkArenaInfo["classArena"];
        echo ' <option value="' . $row["idParkArena"] . '">' .  $rParkArena . '</option>';
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

mysqli_close($conn);
