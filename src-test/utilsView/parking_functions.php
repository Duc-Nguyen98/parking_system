<?php
//! function handle getParkArenaStatus - Check Status Parking

// include_once "db_connection.php";


function getParkArenaStatus($parkArenaCode)
{
    switch ($parkArenaCode) {
        case "1":
            return array("idParkArena" => "A1", "classArena" => "badge badge-primary text-uppercase");
        case "2":
            return array("idParkArena" => "B1", "classArena" => "badge badge-warning text-uppercase");
        default:
            return array("idParkArena" => "", "classArena" => "");
    }
}
//! function handle getStatusInfo - Check Status Parking

function getStatusInfo($statusCode)
{
    switch ($statusCode) {
        case 1:
            return array("status" => "Chỗ Trống", "classStatus" => "badge badge-success");
        case 2:
            return array("status" => "Đang sử dụng", "classStatus" => "badge badge-danger");
        case 3:
            return array("status" => "Đã đặt lịch", "classStatus" => "badge badge-warning");
        default:
            return array("status" => "Đang bảo trì", "classStatus" => "badge badge-dark");
    }
}


function separateDateAndTime($datetimeString) {
    if ($datetimeString == '0000-00-00 00:00:00') {
        return ['date' => 'chưa xác định', 'time' => 'chưa xác định'];
    } else {
        $timestamp = strtotime($datetimeString);
        $date = date('d-m-Y', $timestamp);
        $time = date('H:i:s', $timestamp);
        return ['date' => $date, 'time' => $time];
    }
}
