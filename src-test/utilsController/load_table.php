<?php
include_once "db_connection.php";
include_once "../utilsView/parking_functions.php";

// check value load_option_status and query
if (
    isset($_POST["opStatus"]) &&
    isset($_POST["opEntries"]) &&
    isset($_POST["opParkingArena"])
) {
    $opStatus = $_POST["opStatus"]; // giá trị trạng thái của status
    $opEntries = $_POST["opEntries"]; // Giá trị mặc định cho showEntries là 10
    $opParkingArena = $_POST["opParkingArena"]; // giá trị trạng thái của parking arena
    $sql = "SELECT main_table.*, status_code.description, parking_arena.parkLocation
        FROM main_table 
        LEFT JOIN status_code ON main_table.cStatus = status_code.sId 
        LEFT JOIN (
            SELECT idParkArena, MAX(parkLocation) AS parkLocation
            FROM parking_arena
            GROUP BY idParkArena
        ) parking_arena ON parking_arena.idParkArena = main_table.cParkArena
        WHERE main_table.cStatus = status_code.sId 
        AND IF($opParkingArena = 0, true, main_table.cParkArena = $opParkingArena)
        AND (
            CASE WHEN $opStatus = 0 THEN true 
            ELSE main_table.cStatus = $opStatus END
        )
        ORDER BY main_table.id ASC 
        LIMIT $opEntries";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
    // echo $sql;
}

// Tạo bảng HTML`

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <!-- // echo "<div>Query: " . $sql . "</div>"; -->
        <br>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["cPlate"] ?></td>
            <td><?= $row["description"] ?></td>
            <td><?= $row["cStatus"] ?></td>
            <td><?= separateDateAndTime($row["cTimeCheckIn"])['date'] ?></td>
            <td><?= separateDateAndTime($row["cTimeCheckIn"])['time'] ?></td>

            <td>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input switch-data-cMaintenance" id="<?= $row["id"] ?>" data-id="<?= $row["id"] ?>" <?= ($row["cStatus"] == 4) ? 'checked' : '' ?> onclick="updateMaintenance(<?= $row["id"] ?>, <?= $row["cStatus"] ?>);">
                </div>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

mysqli_close($conn);
?>
<script>
    function updateMaintenance(id, isChecked) {
        console.log(id, isChecked)
        $.ajax({
            type: "POST",
            url: "./utilsAction/update_maintenance.php",
            data: {
                id: id,
                isChecked: isChecked
            },
            success: function(data) {
                // Xử lý kết quả trả về nếu cần thiết
                console.log(' thành công - ba đình ')
            }
        });
    }
</script>