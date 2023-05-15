<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$conn = mysqli_connect("localhost", "root", "", "main_parking");

$opStatus = 0; // giá trị trạng thái của status
$opEntries = 5; // Giá trị mặc định cho showEntries là 10
$opParkingArena = 0; // giá trị trạng thái của parking arena
$sql = "SELECT main_table.*, status_code.description AS sttDescription, parking_arena.*
FROM main_table 
LEFT JOIN status_code ON main_table.cStatus = status_code.sId 
LEFT JOIN parking_arena ON main_table.id = parking_arena.id
WHERE main_table.cStatus = status_code.sId 
AND IF(0 = 0, true, main_table.cParkArena = 0)
AND (
    CASE WHEN 0 = 0 THEN true 
    ELSE main_table.cStatus = 0 END
)
ORDER BY main_table.id ASC 
LIMIT 5";

$result = mysqli_query($conn, $sql);

// Lưu dữ liệu vào một mảng
$data = array();
$idNumber = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Nếu có dữ liệu mới, gửi về client dưới dạng JSON
if (!empty($data)) {
    echo "id: " . time() . "\n";
    echo "data: " . json_encode($data) . "\n\n";
    flush();
}
