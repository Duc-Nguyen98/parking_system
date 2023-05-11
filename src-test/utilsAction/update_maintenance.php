<?php
include_once "../utilsController/db_connection.php";
$isChecked = ($_POST["isChecked"]);
if (isset($_POST["id"]) && isset($_POST["isChecked"])) {
    $id = $_POST["id"];
    $isChecked = $_POST["isChecked"];
    $sql = "UPDATE main_table SET cStatus = IF($isChecked = 4, 1, 4) WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
    mysqli_close($conn);
}
?>
