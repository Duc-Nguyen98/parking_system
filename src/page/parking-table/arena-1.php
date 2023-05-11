<!DOCTYPE html>
<html>

<head>
    <title>Main-1</title>
</head>

<body>
    <?php
    include_once "../../utils/db_connection.php";
    include_once "../../utils/parking_functions.php";
    $sqlSelectStatus = "SELECT  DISTINCT cStatus FROM main_table ORDER BY id ASC ";
    $result2 = mysqli_query($conn, $sqlSelectStatus);


    $sql = "SELECT * FROM main_table ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="col-12 my-2">
        <div class="tab-content">
            <table class="table table-hover  table-reflow ">
                <select  id="status-select" class="custom-select">
                    <option selected disabled hidden>Open this select Status</option>
                    <option value="">All</option>
                    <?php
                    if (mysqli_num_rows($result2) > 0) {
                        // Duyệt qua kết quả truy vấn và tạo các tùy chọn trong select option

                        while ($row = mysqli_fetch_assoc($result2)) {
                            $statusInfo = getStatusInfo($row["cStatus"]);
                            $rStatus = $statusInfo["status"];

                            echo ' <option value="' . $row["cStatus"] . '">'.$rStatus.'</option>';
                        }
                    }
                    ?>
                </select>
                <thead class=" thead-dark">
                    <tr class='text-capitalize my-0'>

                        <th>
                            <p class="my-0">#</p>
                        </th>
                        <th>
                            <p class="my-0">Parking Area</p>
                        </th>
                        <th>
                            <p class="my-0">Check-in time</p>
                        </th>
                        <th>
                            <p class="my-0">Check-out time</p>
                        </th>
                        <th>
                            <p class="my-0">SpotId</p>
                        </th>
                        <th>
                            <p class="my-0">Status</p>
                        </th>
                    </tr>
                </thead>
                <tbody id="main-table-body">
                    <!-- Thêm dữ liệu bảng từ server bằng PHP -->
                    <?php include_once "load_table.php"; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
       
    <script src"../../assets/js/table-dymanic/table-dymanic.js" ></script>
</body>

</html>