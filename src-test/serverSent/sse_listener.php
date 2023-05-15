<?php
// Thiết lập kết nối và gửi dữ liệu SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

include_once "db_connection.php"; // Import file kết nối CSDL

// Khai báo và gán giá trị cho biến $sql
$sql = "SELECT sId FROM `status_code` WHERE 1";

$result = mysqli_query($conn, $sql);

// Xử lý kết quả truy vấn và gửi dữ liệu SSE
while (true) {
    if ($row = mysqli_fetch_assoc($result)) {
        $status = $row['sId'];
    } else {
        $status = 'N/A'; // Giá trị mặc định nếu không có kết quả
    }

    // Gửi dữ liệu SSE
    echo "event: updateStatus\n";
    echo "data: $status\n";
    echo "\n";

    // Flush bộ nhớ đệm để gửi dữ liệu ngay lập tức
    ob_flush();
    flush();

    // Thời gian chờ giữa các lần gửi dữ liệu (ví dụ: 1 giây)
    sleep(1);
}
?>
