<?php

$arrayShow = [5,10, 20, 30, 40];

foreach ($arrayShow as $value) {
    echo '<option value="' . $value . '">' . $value . '</option>';
}
?>