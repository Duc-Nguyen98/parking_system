<?php
//! function handle getParkArenaStatus - Check Status Parking

include_once "db_connection.php";

function getParkArenaStatus($parkArenaCode)
{
    switch ($parkArenaCode) {
        case "0":
            return array("parkArena" => "A1", "classArena" => "badge badge-primary text-uppercase");
        case "1":
            return array("parkArena" => "B1", "classArena" => "badge badge-dark text-uppercase");
        default:
            return array("parkArena" => "", "classArena" => "");
    }
}
//! function handle getStatusInfo - Check Status Parking

function getStatusInfo($statusCode)
{
    switch ($statusCode) {
        case "0":
            return array("status" => "Available", "classStatus" => "badge badge-success");
        case "1":
            return array("status" => "Processing", "classStatus" => "badge badge-danger");
        case "2":
            return array("status" => "Booked", "classStatus" => "badge badge-warning text-white");
        default:
            return array("status" => "", "classStatus" => "");
    }
}
