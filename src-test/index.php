<!DOCTYPE html>
<html>

<head>
    <title>Ajax Select Option</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'> -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="hero-anime">

    <div class="navigation-wrap bg-light start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="/" target="_blank"><img src="https://menu.hnmu.edu.vn/Content/appside/assets/img/HNMU-logo.png" alt="HNMU-Logo"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto py-4 py-md-0">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Parking Simple
                                    </a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Parking Detailed
                                    </a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link disabled" href="#">Analysis & Report</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4 py-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <select class="custom-select text-capitalize" id="opStatus">
                </select>
            </div>
            <div class="col-4">
                <select class="custom-select" id="opEntries">
                </select>
            </div>
            <div class="col-4">
                <select class="custom-select text-capitalize" id="opParkingArena">
                </select>
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="col-md-12 p-0">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="result"> </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src='./assets/js/nav-bar.js'></script>
    <script src='./assets/js/path-dynamic.js'></script>
    <!-- <div id="result"></div> -->
    <script>
        $(document).ready(function() {
            loadStatus();

            function loadStatus() {
                $.ajax({
                    type: "POST",
                    url: "./utilsController/load_option_status.php",
                    success: function(opStatus) {
                        $("#opStatus").html(opStatus);
                    }
                });
            }

            loadEntries();

            function loadEntries() {
                $.ajax({
                    type: "POST",
                    url: "./utilsView/value_show_entries.php",
                    success: function(opEntries) {
                        $("#opEntries").html(opEntries);
                    }
                });
            }

            loadParkingArena();

            function loadParkingArena() {
                $.ajax({
                    type: "POST",
                    url: "./utilsController/load_option_parking_arena.php",
                    success: function(opParkingArena) {
                        $("#opParkingArena").html(opParkingArena);
                    }
                });
            }

            //!Handle action select option all

            $("#opStatus, #opEntries, #opParkingArena").change(function() {
                var opStatus = $("#opStatus").val();
                var opEntries = $("#opEntries").val();
                var opParkingArena = $("#opParkingArena").val();

                if (opStatus === '') {
                    loadTable();
                } else {
                    loadTable(opStatus, opEntries, opParkingArena);
                }
            });

            // load table 
            loadTable();


            function loadTable(opStatus = 0, opEntries = 5, opParkingArena = 0) {
                console.log(` ${opStatus} - ${opEntries} - ${opParkingArena}`)
                $.ajax({
                    type: "POST",
                    url: "./utilsController/load_table.php",
                    data: {
                        opStatus: opStatus,
                        opEntries: opEntries,
                        opParkingArena: opParkingArena,
                    },
                    success: function(result) {
                        $("#result").html(result);
                    }
                });
            }
            //load show entries


        });
    </script>



</body>

</html>