<!DOCTYPE html>
<html>

<head>
    <title>Ajax Select Option</title>
    <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://kit.fontawesome.com/4ecb329ca8.js" crossorigin="anonymous"></script> -->
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
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <form class="d-flex justify-content-between text-capitalize">
                    <div class="form-check px-0">
                        <label for="opStatus" class="pr-3">Trạng thái đỗ xe</label>
                        <select class="custom-select text-capitalize" id="opStatus">
                        </select>
                    </div>
                    <div class="form-check px-0">
                        <label for="opParkingArena" class="pr-3">Khu vực đậu xe</label>
                        <select class="custom-select text-capitalize" id="opParkingArena">
                        </select>
                    </div>
                    <div class="form-check px-0">
                        <label for="opEntries" class="pr-3">Số lượng hiển thị</label>
                        <select class="custom-select" id="opEntries">
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 p-0">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="result"> </div>
                    <table class="table table-condensed table-hover table-striped" id="table">
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
                        </tbody>
                    </table>
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
    <script src='./assets/js/handle-script.js'></script>

    <script>
        // Load initial data with AJAX
        loadParkingArenaOptions();

        function loadParkingArenaOptions() {
            $.ajax({
                url: './utilsController/load_option_parking_arena.php',
                success: function(data) {
                    // Populate initial data into page
                    $('#opParkingArena').html(data);

                    // Setup SSE to listen for updates
                    if (typeof(EventSource) !== "undefined") {
                        var source = new EventSource("./utilsController/load_option_status.php");
                        source.addEventListener("message", function(event) {
                            var data = JSON.parse(event.data);
                            // console.log(data);
                            data.forEach(function(row) {
                                // Tìm option có value bằng với id của row trong select
                                var $option = $("#opStatus option[value='" + row.id + "']");
                                if ($option.length > 0) {
                                    // Nếu option đã tồn tại, chỉ cập nhật nội dung của option đó
                                    $option.text(row.description);
                                } else {
                                    // Nếu option chưa tồn tại, thêm option mới vào select
                                    var option = $("<option>").attr("value", row.id).text(row.description);
                                    $("#opStatus").append(option);
                                }
                            });
                            $("#opStatus option:first-child").attr("selected", "selected");
                        });
                    } else {
                        console.log('SSE not supported');
                    }
                }
            });
        }



        // if (typeof(EventSource) !== "undefined") {
        //     var source = new EventSource("sse.php");
        //     source.addEventListener("message", function(event) {
        //         var data = JSON.parse(event.data);
        //         // console.log(data);
        //         data.forEach(function(row) {
        //             // Tìm option có value bằng với id của row trong select
        //             var $option = $("#opStatus option[value='" + row.id + "']");
        //             if ($option.length > 0) {
        //                 // Nếu option đã tồn tại, chỉ cập nhật nội dung của option đó
        //                 $option.text(row.description);
        //             } else {
        //                 // Nếu option chưa tồn tại, thêm option mới vào select
        //                 var option = $("<option>").attr("value", row.id).text(row.description);
        //                 $("#opStatus").append(option);
        //             }
        //         });

        // data.forEach(function(row) {
        //     var $tr = $("#table tr[data-id='" + row.id + "']");
        //     if ($tr.length > 0) {
        //         // Nếu bản ghi đã tồn tại, chỉ cập nhật nội dung của dòng đó
        //         var html = "";
        //         // html += "<option>" + row.sId + "</option>";

        //         html += "<option>" + row.description + "</option>";
        //         // html += "<td>" + row.email + "</td>";
        //         // html += "<td>" + row.phone + "</td>";
        //         $tr.html(html);
        //     } else {
        //         // Nếu bản ghi chưa tồn tại, thêm dòng mới vào bảng
        //         var html = "";
        //         html += "<tr data-id='" + row.sId + "'>";

        //         // html += "<td>" + row.sId + "</td>";
        //         html += "<option>" + row.description + "</option>";
        //         // html += "<td>" + row.name + "</td>";
        //         // html += "<td>" + row.email + "</td>";
        //         // html += "<td>" + row.phone + "</td>";
        //         html += "</tr>";
        //         $("#table tbody").append(html);
        //     }
        // });
        //     });
        // } else {
        //     console.log('SSE not supported');
        // }
    </script>
    <script>
        loadOptionParkingArena();
        // Load initial data with AJAX
        function loadOptionParkingArena() {
            $.ajax({
                url: './utilsController/load_option_parking_arena.php',
                success: function(data) {
                    // Populate initial data into page
                    $('#opParkingArena').html(data);

                    // Setup SSE to listen for updates
                    if (typeof(EventSource) !== "undefined") {
                        var source = new EventSource("./utilsController/load_option_parking_arena.php");
                        source.addEventListener("message", function(event) {
                            // Update table with new data
                            var data = JSON.parse(event.data);
                            // console.log(data);
                            data.forEach(function(row) {
                                // Tìm option có value bằng với id của row trong select
                                var $option = $("#opParkingArena option[value='" + row.idParkArena + "']");
                                if ($option.length > 0) {
                                    // Nếu option đã tồn tại, chỉ cập nhật nội dung của option đó
                                    $option.text(row.parkName);
                                } else {
                                    // Nếu option chưa tồn tại, thêm option mới vào select
                                    var option = $("<option>").attr("value", row.idParkArena).text(row.parkName);
                                    $("#opParkingArena").append(option);
                                }
                            });
                            $("#opParkingArena option:first-child").attr("selected", "selected");

                        });
                    } else {
                        console.log('SSE not supported');
                    }
                }
            });
        }
    </script>
    <script>
        var opStatus = isNaN(parseInt($("#opStatus").val())) ? 0 : parseInt($("#opStatus").val());
        var opEntries = isNaN(parseInt($("#opEntries").val())) ? 0 : parseInt($("#opEntries").val());
        var opParkingArena = isNaN(parseInt($("#opParkingArena").val())) ? 0 : parseInt($("#opParkingArena").val());
        console.log(opStatus,opEntries,opParkingArena);
        // $("#opStatus, #opEntries, #opParkingArena").change(function() {
        //     var opStatus = parseInt($("#opStatus").val()); // Chuyển đổi giá trị thành kiểu số
        //     var opEntries = parseInt($("#opEntries").val()); // Chuyển đổi giá trị thành kiểu số
        //     var opParkingArena = parseInt($("#opParkingArena").val()); // Chuyển đổi giá trị thành kiểu số

        // });



        function loadTable() {
            $.ajax({
                url: './utilsController/load_table.php',
                success: function(data) {
                    $('#opParkingArena').html(data);

                    if (typeof(EventSource) !== "undefined") {
                        var source = new EventSource("./utilsController/load_table.php");
                        source.addEventListener("message", function(event) {
                            var data = JSON.parse(event.data);
                            console.log(data);

                            data.forEach(function(row) {
                                var $tr = $("#table tr[data-id='" + row.id + "']");
                                if ($tr.length > 0) {
                                    // Nếu bản ghi đã tồn tại, chỉ cập nhật nội dung của dòng đó
                                    var html = "";
                                    html += `
                                    <td>
                                        <button data-toggle="collapse" data-target="#collapseTbl${row.id}" class="btn btn-outline-secondary toggleButton"><i class="bi bi-plus"></i></button>
                                    </td>
                                    <td><span class="badge badge-pill badge-light">${row.id}</span></td>
                                    <td class="text-uppercase"><span class="badge badge-secondary">${row.cPlate}</span></td>
                                    <td><span class="text-capitalize badge badge-light">${separateDateAndTime(row.cTimeCheckIn)['date']}</span></td>
                                    <td><span class="text-capitalize badge badge-light">${separateDateAndTime(row.cTimeCheckOut)['date']}</span></td>
                                    <td class="text-capitalize"><span class="${getParkArenaStatus(row.cParkArena).classArena}">${row.parkName}-p${row.parkLocation}</span></td>
                                    <td><span class="${getStatusInfo(row.cStatus).classStatus}">${row.sttDescription}</span></td>

                                `;

                                    $tr.html(html);
                                } else {
                                    // Nếu bản ghi chưa tồn tại, thêm dòng mới vào bảng
                                    var html = "";
                                    html += "<tr data-id='" + row.id + "'>";
                                    html += `
                                    <td>
                                        <button data-toggle="collapse" data-target="#collapseTbl${row.id}" class="btn btn-outline-secondary toggleButton"><i class="bi bi-plus"></i></button>
                                    </td>
                                    <td><span class="badge badge-pill badge-light">${row.id}</span></td>
                                    <td class="text-uppercase"><span class="badge badge-secondary">${row.cPlate}</span></td>
                                    <td><span class="text-capitalize badge badge-light">${separateDateAndTime(row.cTimeCheckIn)['date']}</span></td>
                                    <td><span class="text-capitalize badge badge-light">${separateDateAndTime(row.cTimeCheckOut)['date']}</span></td>
                                    <td class="text-capitalize"><span class="${getParkArenaStatus(row.cParkArena).classArena}">${row.parkName}-p${row.parkLocation}</span></td>
                                    <td><span class="${getStatusInfo(row.cStatus).classStatus}">${row.sttDescription}</span></td>
                                </tr>`;

                                    $("#table tbody").append(html);
                                }
                            });
                        });
                    } else {
                        console.log('SSE not supported');
                    }
                }
            });
        }

        loadTable();
    </script>

</body>

</html>