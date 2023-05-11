    <!DOCTYPE html>
    <html>

    <head>
        <title>Chuyển đổi giữa hai trang PHP</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#content").load("./page/parking-table/arena-1.php");

                $("#btn1").click(function() {
                    $("#content").load("./page/parking-table/arena-1.php");
                });

                $("#btn2").click(function() {
                    $("#content").load("./page/parking-table/arena-2.php");
                });
            });
        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">HNMU - Parking System</a>
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
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="options" id="btn1" autocomplete="off" checked> Chuyển đến trang main-1.php

            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="btn2" autocomplete="off"> Chuyển đến trang main-2.php
            </label>
        </div>
        </nav>
        <div id="content"></div>


    </body>

    </html>