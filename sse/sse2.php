<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Thực hiện truy vấn để lấy dữ liệu bảng
$conn = mysqli_connect("localhost", "root", "", "main_parking");
$sql = "SELECT DISTINCT idParkArena, parkName FROM parking_arena;";
$result = mysqli_query($conn, $sql);

// Lưu dữ liệu vào một mảng
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Nếu có dữ liệu mới, gửi về client dưới dạng JSON
if (!empty($data)) {
    echo "id: " . time() . "\n";
    echo "data: " . json_encode($data) . "\n\n";
    flush();
}
