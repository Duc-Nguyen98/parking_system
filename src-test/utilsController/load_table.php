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
    echo ' <table class="table table-condensed table-hover table-striped" >';

?>
    <thead>
        <tr class="table table-condensed table-hover table-striped">
            <th></th>
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
            // $rStatus = $statusInfo["status"];
            $rClassStatus = $statusInfo["classStatus"];
        ?>
            <!-- <?= "<div>Query: " . $sql . "</div>"; ?> -->
            <tr>
                <td>
                    <button data-toggle="collapse" data-target="#collapseTbl<?= $idNumber ?>" class="btn btn-outline-secondary toggleButton"><i class="bi bi-plus"></i></button>

                </td>
                <td><span class="badge badge-pill  <?= ($row["cStatus"] == 4) ? 'badge-danger' : 'badge-success' ?>"><?= $idNumber ?></span></td>
                <td class="text-uppercase"><span class="badge badge-secondary"><?= $row["cPlate"] ?></span></td>
                <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckIn"])['date'] ?></span></td>
                <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckOut"])['date'] ?></span></td>
                <td class="text-capitalize"><span class=" <?= $rClassArena ?>"><?= $rParkArena . '-p' . $row["parkLocation"] ?></span></td>
                <td><span class="status-cell <?= $rClassStatus ?>"><?= $row["cStatus"] ?></span></td>
            </tr>
            <tr>
                <td colspan="12" class="hiddenRow">
                    <div class="accordian-body collapse" id="collapseTbl<?= $idNumber ?>">
                        <table class="table table-striped">
                            <thead>
                                <tr class="table table-condensed table-hover table-striped ">
                                    <th>Tên khách hàng</th>
                                    <th>Giờ vào</th>
                                    <th>Giờ ra</th>
                                    <th>Mô tả khu vực</th>
                                    <th>Nâng Cấp | Bảo trì</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <!-- <td colspan="2"></td> -->
                                    <td class="text-uppercase font-weight-normal"><span class="badge badge-secondary"><?= $row["cName"] ?></span></td>
                                    <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckIn"])['time'] ?></span></td>
                                    <td><span class="text-capitalize badge badge-light"><?= separateDateAndTime($row["cTimeCheckOut"])['time'] ?></span></td>
                                    <td><span class="text-capitalize badge badge-light"><?= $row["description"] ?></span></td>
                                    <td>
                                        <div class="custom-control custom-switch read-only">
                                            <input type="checkbox" class="custom-control-input switch-data-cMaintenance" id="<?= $row["id"] ?>" data-id="<?= $row["id"] ?>" <?= ($row["cStatus"] == 4) ? 'checked' : '' ?> onclick="updateMaintenance(<?= $row["id"] ?>, <?= $row["cStatus"] ?>);">
                                            <label class="custom-control-label" for="customSwitch1"><span class="text-capitalize badge badge-light">Đang được bảo trì</span></label>
                                        </div>
                                    </td>
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
        function toggleButton() {
            $('.toggleButton').click(function() {
                var button = $(this);
                var icon = $(this).find('i');
                if (icon.hasClass('bi-plus')) {
                    icon.removeClass('bi-plus').addClass('bi bi-dash ');
                    button.addClass('active');
                } else {
                    icon.removeClass('bi bi-dash').addClass('bi-plus');
                    button.removeClass('active');
                }
            });
        }

        toggleButton();


        function updateMaintenance(id, isChecked) {
            // console.log(id, isChecked)
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