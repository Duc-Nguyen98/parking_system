<?php
include_once "../src/utils/db_connection.php";

// check value load_option_status and query 
if (isset($_POST['opStatus'])  && isset($_POST['opEntries']) && isset($_POST['opParkingArena'])) {
    $opStatus = $_POST['opStatus']; // giá trị trạng thái của status
    $opEntries = $_POST['opEntries']; // Giá trị mặc định cho showEntries là 10
    $opParkingArena = $_POST['opParkingArena']; // giá trị trạng thái của parking arena
    echo 'hi';
    echo $opStatus;
    echo $opParkingArena;
    echo 'ha';
    if ($opStatus == 0) {
        $sql = "SELECT main_table.*, status_code.description, parking_arena.parkLocation
        FROM main_table 
        LEFT JOIN status_code ON main_table.cStatus = status_code.sId 
        LEFT JOIN (
            SELECT idParkArena, MAX(parkLocation) AS parkLocation
            FROM parking_arena
            GROUP BY idParkArena
        ) parking_arena ON parking_arena.idParkArena = main_table.cParkArena
        WHERE main_table.cStatus = status_code.sId 
        ORDER BY main_table.id ASC 
        LIMIT 10;";
    } else {
        echo 'x=>' . $opStatus;
        echo 'y=>' . $opParkingArena;
        $sql = "SELECT main_table.*, status_code.description, parking_arena.parkLocation
        FROM main_table 
        LEFT JOIN status_code ON main_table.cStatus = status_code.sId 
        LEFT JOIN (
            SELECT idParkArena, MAX(parkLocation) AS parkLocation
            FROM parking_arena
            GROUP BY idParkArena
        ) parking_arena ON parking_arena.idParkArena = main_table.cParkArena
        WHERE main_table.cStatus = $opStatus
        AND IF($opParkingArena = 0, true, parking_arena.idParkArena = $opParkingArena )
        ORDER BY main_table.id ASC 
        LIMIT $opEntries;";
    }
}
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error: ' . mysqli_error($conn));
    // echo $sql;
}

// Tạo bảng HTML`

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "<div>Query: " . $sql . "</div>";
        echo "<br>";
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["cName"] . "</td>";
        echo "<td>" . $row["cPlate"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        // echo "<td>" . $showEntries . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

mysqli_close($conn);
