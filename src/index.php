<!DOCTYPE html>
<html>

<head>
    <!-- <meta http-equiv="refresh" content="5"> -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include_once "utils/db_connection.php";
    include_once "utils/parking_functions.php";
    
    $sql = "SELECT * FROM main_table ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    ?> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Parking System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Parking Arena 1
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#" data-filter="all">All</a>
                        <a class="dropdown-item" href="#" data-filter="available">Available Slot</a>
                        <a class="dropdown-item" href="#" data-filter="processing">Processing</a>
                        <a class="dropdown-item" href="#" data-filter="booked">Booked</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- <ul class="nav nav-tabs">
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
            </ul> -->

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

            <div class="col-12 my-2">
                <div class="tab-content">
                    <table class="table table-hover  table-reflow ">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                        ?>
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
                            <tbody>
                                <tr>
                                    <td><?= $idNumber ?></td>
                                    <td><span class="<?= $rClassArena ?>">hmnu:<?= $rParkArena ?></span></td>
                                    <td><?= $row['cTimeCheckIn'] ?></td>
                                    <td><?= $row['cTimeCheckOut'] ?></td>
                                    <td><span class="<?= $rClassArena ?>"><?= $rParkArena . "-P". $row['cParkLocation'] ?></td>
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