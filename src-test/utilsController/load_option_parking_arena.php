<?php
include_once "db_connection.php";
include_once "../utilsView/parking_functions.php";
$sql = "SELECT DISTINCT idParkArena FROM parking_arena ORDER BY idParkArena ASC;";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Tạo bảng HTML
if (mysqli_num_rows($result) > 0) {
    echo '<option value="0" >Tất cả</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $parkArenaInfo = getParkArenaStatus($row["idParkArena"]);
        $rParkArena = $parkArenaInfo["idParkArena"];
        $rClassArena = $parkArenaInfo["classArena"];
        echo ' <option class="text-capitalize" value="' . $row["idParkArena"] . '">' . 'Khu vực '. $rParkArena . '</option>';
    }
} else {
    echo "<tr><td colspan='4'>Không tìm thấy dữ liệu nào</td></tr>";
}

mysqli_close($conn);
