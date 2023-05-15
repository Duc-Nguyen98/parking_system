<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SSE Demo</title>
</head>
<body>
    <table id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        if (typeof(EventSource) !== "undefined") {
            // var source = new EventSource("sse.php");
            var source = new EventSource("sse.php");
            source.addEventListener("message", function(event) {
                var data = JSON.parse(event.data);
                console.log(data);
                data.forEach(function(row) {
                    var $tr = $("#table tr[data-id='" + row.id + "']");
                    if ($tr.length > 0) {
                        // Nếu bản ghi đã tồn tại, chỉ cập nhật nội dung của dòng đó
                        var html = "";
                        html += "<td>" + row.id + "</td>";
                        html += "<td>" + row.cName + "</td>";
                        html += "<td>" + row.cStatus + "</td>";
                        html += "<td>" + row.cPlate + "</td>";
                        $tr.html(html);
                    } else {
                        // Nếu bản ghi chưa tồn tại, thêm dòng mới vào bảng
                        var html = "";
                        html += "<tr data-id='" + row.id + "'>";
                        html += "<td>" + row.id + "</td>";
                        html += "<td>" + row.cName + "</td>";
                        html += "<td>" + row.cStatus + "</td>";
                        html += "<td>" + row.cPlate + "</td>";
                        html += "</tr>";
                        $("#table tbody").append(html);
                    }
                });
            });
        } else {
            console.log('SSE not supported');
        }
    </script>
</body>
</html>
