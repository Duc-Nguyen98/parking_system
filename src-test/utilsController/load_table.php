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
    $sql = "SELECT main_table.*, status_code.description, parking_arena.*
        FROM main_table 
        LEFT JOIN status_code ON main_table.cStatus = status_code.sId 
        LEFT JOIN parking_arena ON main_table.id = parking_arena.id
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
    echo ' <table class="table table-condensed table-hover table-striped"> ';

?>
    <thead>
        <tr class="text-uppercase font-weight-bolder">
            <th>#</th>
            <th>Biển số</th>
            <th>Ngày vào</th>
            <th>Ngày ra</th>
            <th>Vị trí</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $idNumber = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $idNumber++;
            //! Variable getParkArenaStatus
            $parkArenaInfo = getParkArenaStatus($row["cParkArena"]);
            $rParkArena = $parkArenaInfo["idParkArena"];
            $rClassArena = $parkArenaInfo["classArena"];
            //!  Variable getStatusInfo
            $statusInfo = getStatusInfo($row["cStatus"]);
            $rStatus = $statusInfo["status"];
            $rClassStatus = $statusInfo["classStatus"];
        ?>
            <!-- <?= "<div>Query: " . $sql . "</div>"; ?> -->
            <tr data-toggle="collapse" data-target="#collapseTbl<?= $idNumber ?>" class="accordion-toggle table-light">
                <td><span class="badge badge-pill badge-light"><?= $idNumber ?></span></td>
                <!-- <td class="text-uppercase font-weight-normal"><?= $row["cName"] ?></td> -->
                <td class="text-uppercase"><span class="badge badge-secondary"><?= $row["cPlate"] ?></span></td>
                <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckIn"])['date'] ?></span></td>
                <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckOut"])['date'] ?></span></td>
                <td class="text-capitalize"><span class=" <?= $rClassArena ?>"><?= $rParkArena . '-p' . $row["parkLocation"] ?></span></td>
                <td><span class="<?= $rClassStatus ?>"><?= $rStatus ?></span></td>
                <!-- <td>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input switch-data-cMaintenance" id="<?= $row["id"] ?>" data-id="<?= $row["id"] ?>" <?= ($row["cStatus"] == 4) ? 'checked' : '' ?> onclick="updateMaintenance(<?= $row["id"] ?>, <?= $row["cStatus"] ?>);">
                </div>
     
                <!-- <td><?= separateDateAndTime($row["cTimeCheckIn"])['date'] ?></td>
            <td><?= separateDateAndTime($row["cTimeCheckIn"])['time'] ?></td> -->
            </tr>
            <tr>
                <td colspan="12" class="hiddenRow">
                    <div class="accordian-body collapse" id="collapseTbl<?= $idNumber ?>">
                        <table class="table table-striped">
                            <thead>
                                <tr class="table table-condensed table-hover table-striped">
                                    <!-- <th colspan="2">s</th> -->
                                    <th>Tên khách hàng</th>
                                    <th>Giờ vào</th>
                                    <th>Giờ ra</th>
                                    <th>Mô tả khu vực</th>
                                    <th>Bảo trì khu vực đỗ xe</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr data-toggle="collapse" class="accordion-toggle" data-target="#collapseTbl<?= $idNumber ?>">
                                    <!-- <td colspan="2"></td> -->
                                    <td class="text-uppercase font-weight-normal"><span class="badge badge-secondary"><?= $row["cName"] ?></span></td>
                                    <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckIn"])['time'] ?></span></td>
                                    <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckOut"])['time'] ?></span></td>
                                    <td><span class="text-capitalize badge badge-light"><?= $row["description"] ?></span></td>
                                    <td>
                                        <div class="custom-control custom-switch dislabel">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1">Đang được bảo trì</label>
                                        </div>
                                    </td>

                                    <!-- <td>
                                        <a href="#" class="btn btn-default btn-sm">
                                            <i class="glyphicon glyphicon-cog"></i>
                                        </a>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
    <?php
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<tr><td colspan='8'>Không tìm thấy dữ liệu nào</td></tr>";
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