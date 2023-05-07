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

    //Execute SQL query
    $sql = "SELECT * FROM main_table ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    //Display query result
    ?>

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
                    //! Handle check status parking
                    $valueVirtual = $row["cStatus"];

                    $result = $valueVirtual;
                    echo '
            <tbody>
                <tr>
                    <td>' . $row["id"] . '</td>
                    <td>' . $row["cId"] . '</td>
                    <td>' . $row["cName"] . '</td>
                    <td>' . $row["cPlate"] . '</td>
                    <td>' . $row["cTimecheckin"] . '</td>
                    <td>' . $row["cTimecheckout"] . '</td>
                    <td>' . $row["cParkArena"] . '</td>
                    <td>' . $row["cParkLocation"] . '</td>
                    <td><span class="badge badge-danger">' . $if() . '</span></td>
                    <!-- <td><span class="badge badge-danger">FULL</span></td> -->
                </tr>
            </tbody>';
                }
            } else {
                echo "No results found.";
            }
            ?>
        </table>
    </div>

    <table class="table table-sm-responsive"><!-- ... --></table>
    <table class="table table-md-responsive"><!-- ... --></table>
    <table class="table table-lg-responsive"><!-- ... --></table>
    <table class="table table-xl-responsive"><!-- ... --></table>
    <?php
    mysqli_close($conn);
    ?>




</body>

</html>