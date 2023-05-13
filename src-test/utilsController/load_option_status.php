<?php
include_once "db_connection.php";
$sql = "SELECT * FROM `status_code` WHERE 1";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Tạo bảng HTML
if (mysqli_num_rows($result) > 0) {
    echo '<option value="0">Tất cả</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo ' <option class="text-capitalize" value="' . $row["sId"] . '">' .  $row["description"] . '</option>';
    }
} else {
    echo "<tr><td colspan='4'>Không tìm thấy dữ liệu nào</td></tr>";
}

mysqli_close($conn);

?>