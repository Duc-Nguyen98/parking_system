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
            $("#btn1").click(function() {
                $("#content").load("main-1.php");
            });

            $("#btn2").click(function() {
                $("#content").load("main-2.php");
            });
        });
    </script>
</head>

<body>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="btn1" autocomplete="off" checked> Chuyển đến trang main-1.php

        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="btn2" autocomplete="off"> Chuyển đến trang main-2.php
        </label>
    </div>
    <div id="content"></div>




</body>

</body>

</html>