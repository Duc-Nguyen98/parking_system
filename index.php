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
    //Connect to database and create table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "main_parking";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
        echo "<a href='install.php'>If first time running click here to install database</a>";
    }

    //? Handle:Execute SQL query View data Begin
    $sql = "SELECT * FROM main_table ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    //? Handle: Display query result End
    ?>

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
                            echo "<thead>" .
                                "<tr>" .
                                "<th><p class='text-capitalize'>id</p></th>" .
                                "<th><p class='text-capitalize'>cid</p></th>" .
                                "<th><p class='text-capitalize'>cname</p></th>" .
                                "<th><p class='text-capitalize'>cplate</p></th>" .
                                "<th><p class='text-capitalize'>ctimecheckin</p></th>" .
                                "<th><p class='text-capitalize'>ctimecheckout</p></th>" .
                                "<th><p class='text-capitalize'>cparkarena</p></th>" .
                                "<th><p class='text-capitalize'>cparklocation</p></th>" .
                                "<th><p class='text-capitalize'>cstatus</p></th>" .
                                "</tr>" .
                                "</thead>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                //?Handle: Check Status Parking Begin
                                $rParkArena = "";
                                $rClassArena = "";
                                switch ($row["cParkArena"]) {
                                    case "0":
                                        $rParkArena = "HNMU:A1";
                                        $rClassArena = "badge badge-primary";

                                        break;
                                    case "1":
                                        $rParkArena = "HNMU:B1";
                                        $rClassArena = "badge badge-dark";

                                        break;
                                }

                                //?Handle:  Check Status Parking End

                                //?Handle: Check Status Parking Begin

                                $rStatus = "";
                                $rClass = "";
                                switch ($row["cStatus"]) {
                                    case "0":
                                        $rStatus = "Available";
                                        $rClass = "badge badge-success";
                                        break;
                                    case "1":
                                        $rStatus = "Processing";
                                        $rClass = "badge badge-danger";
                                        break;
                                    case "2":
                                        $rStatus = "Booked";
                                        $rClass = "badge badge-warning text-white";
                                        break;
                                }

                                //?Handle:  Check Status Parking End



                                echo '
                                    <tbody>
                                    <tr>
                                        <td>' . $row["id"] . '</td>
                                        <td>' . $row["cId"] . '</td>
                                        <td>' . $row["cName"] . '</td>
                                        <td>' . $row["cPlate"] . '</td>
                                        <td>' . $row["cTimeCheckIn"] . '</td>
                                        <td>' . $row["cTimeCheckOut"] . '</td>
                                        <td><span class="' . $rClassArena . '">' . $rParkArena . '</span></td> 


                                        <td>' . $row["cParkLocation"] . '</td>
                                        <td><span class="' . $rClass . '">' . $rStatus . '</span></td> 
                                    </tr>
                                    </tbody>';
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