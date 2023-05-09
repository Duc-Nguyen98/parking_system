<!DOCTYPE html>
<html>

<head>
    <title>Chuyển đổi giữa hai trang PHP</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/css/style.css">


</head>

<body class="hero-anime">

    <!-- TODO: handle !-->
    <!-- ...... notepad -->
    <div class="navigation-wrap bg-light start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <a class="navbar-brand" href="/" target="_blank"><img src="./assets/image/hnmu.png" alt="HNMU-Logo"></a>

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
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/all.svg" style="width:15%" alt="mô tả" /> All Slots</a>
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/parking-area.svg" style="width:15%" alt="mô tả" /> Available</a>
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/no-parking.svg" style="width:15%" alt="mô tả" /> Processing </a>
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/calendar-date.svg" style="width:15%" alt="mô tả" /> Booked </a>
                                    </div>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Parking Detailed
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/all.svg" style="width:15%" alt="mô tả" /> All Slots</a>
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/parking-area.svg" style="width:15%" alt="mô tả" /> Available</a>
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/no-parking.svg" style="width:15%" alt="mô tả" /> Processing </a>
                                        <a class="dropdown-item" href="#"><img src="assets/icon-svg/calendar-date.svg" style="width:15%" alt="mô tả" /> Booked </a>
                                    </div>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                    <a class="nav-link" href="#">Analysis & Report</a>
                                </li>
                                <!-- <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                        <a class="nav-link" href="#">Contact</a>
                                    </li> -->
                            </ul>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section full-height">
        <div class="absolute-center">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Bootstrap<br>Menu</h1>
                            <p>scroll down for nav animation</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div id="switch">
                                <div id="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-5 py-5">
    </div>
    <!-- TODO: handle end !-->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src='./assets/js/nav-bar.js'></script>


</body>

</html>