<?php

$mysqli = mysqli_connect("192.168.1.244", "root", "53zazYRD", "xianlu");
var_dump($mysqli);
//if ($mysqli->connect_error) {
//    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
//}
//$query = $mysqli->query("select * from lym_common_area where level = 3");
//while ($row = mysql_fetch_row($query)) {
//    var_dump($row);
//}