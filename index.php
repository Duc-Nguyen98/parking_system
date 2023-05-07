<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="5">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "main_parking";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection and show error message if failed
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
        "<a href='install.php'>If first time running click here to install database</a>";
    }

    // Execute SQL query to retrieve data from the database
    $sql = "SELECT * FROM main_table ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);

    // Display the query result


    //! function handle getParkArenaStatus - Check Status Parking
    function getParkArenaStatus($parkArenaCode)
    {
        switch ($parkArenaCode) {
            case "0":
                return array("parkArena" => "A1", "classArena" => "badge badge-primary text-uppercase");
            case "1":
                return array("parkArena" => "B1", "classArena" => "badge badge-dark text-uppercase");
            default:
                return array("parkArena" => "", "classArena" => "");
        }
    }

    //! function handle getStatusInfo - Check Status Parking

    function getStatusInfo($statusCode)
    {
        switch ($statusCode) {
            case "0":
                return array("status" => "Available", "classStatus" => "badge badge-success");
            case "1":
                return array("status" => "Processing", "classStatus" => "badge badge-danger");
            case "2":
                return array("status" => "Booked", "classStatus" => "badge badge-warning text-white");
            default:
                return array("status" => "", "classStatus" => "");
        }
    }

    ?>
    <div class="container">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#!">Tổng Quan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Parking Arena 1</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#!">All</a>
                        <a class="dropdown-item" href="#!">Available Slot</a>
                        <a class="dropdown-item" href="#!">Processing</a>
                        <a class="dropdown-item" href="#!">Booked</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Parking Arena 2</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#!">All</a>
                        <a class="dropdown-item" href="#!">Available Slot</a>
                        <a class="dropdown-item" href="#!">Processing</a>
                        <a class="dropdown-item" href="#!">Booked</a>
                    </div>
                </li>
            </ul>

            <!-- //TODO: Option Display Slot Table View or Grid View Begin -->
            <!-- <div class="col-12 my-2">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked> Table
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Grid
                    </label>
                </div>
            </div> -->
            <!-- //TODO: Option Display Slot Table View or Grid View End -->

            <div class="col-12 my-2">
                <div class="tab-content">
                    <table class="table table-responsive">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                        ?>
                            <thead>
                                <tr>

                                    <th>
                                        <p class='text-capitalize'>STT</p>
                                    </th>
                                    <th>
                                        <p class='text-capitalize'>Parking Area</p>
                                    </th>
                                    <!-- <th>
                                        <p class='text-capitalize'>cid</p>
                                    </th> -->
                                    <!-- <th>
                                        <p class='text-capitalize'>cname</p>
                                    </th>
                                    <th>
                                        <p class='text-capitalize'>cplate</p>
                                    </th> -->
                                    <th>
                                        <p class='text-capitalize'>Check-in time</p>
                                    </th>
                                    <th>
                                        <p class='text-capitalize'>Check-out time</p>
                                    </th>
                                    <th>
                                        <p class='text-capitalize'>SpotId</p>
                                    </th>
                                    <th>
                                        <p class='text-capitalize'>Status</p>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $idNumber = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $idNumber++;
                                //! Variable getParkArenaStatus
                                $parkArenaInfo = getParkArenaStatus($row["cParkArena"]);
                                $rParkArena = $parkArenaInfo["parkArena"];
                                $rClassArena = $parkArenaInfo["classArena"];
                                //!  Variable getStatusInfo
                                $statusInfo = getStatusInfo($row["cStatus"]);
                                $rStatus = $statusInfo["status"];
                                $rClassStatus = $statusInfo["classStatus"];
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $idNumber ?></td>
                                        <td><span class="<?= $rClassArena ?>">hmnu:<?= $rParkArena ?></span></td>
                                        <!-- <td><span class="text-uppercase"><?= $row['cId'] ?></span></td> -->
                                        <!-- <td><?= $row['cName'] ?></td> -->
                                        <!-- <td><?= $row['cPlate'] ?></td> -->
                                        <td><?= $row['cTimeCheckIn'] ?></td>
                                        <td><?= $row['cTimeCheckOut'] ?></td>
                                        <td><?= $rParkArena . '-' . 'P' . $row['cParkLocation'] ?></td>
                                        <td><span class="<?= $rClassStatus ?>"><?= $rStatus ?></span></td>
                                    </tr>
                                </tbody>
                        <?php
                            }
                        } else {
                            echo "No results found.";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php
        mysqli_close($conn);
        ?>
</body>

</html>