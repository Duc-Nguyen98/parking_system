$(document).ready(function() {
    $("#content").load("./page/parking-table/arena-1.php");

    $("#btn1").click(function() {
        $("#content").load("./page/parking-table/arena-1.php");
    });

    $("#btn2").click(function() {
        $("#content").load("./page/parking-table/arena-2.php");
    });
});