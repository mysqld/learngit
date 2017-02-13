<?php

function checkstr($str) {
	return preg_match("/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]+$/u", $str);
}
function checkstr2($str) {
	return preg_match("/^[^0-9_]+/", $str);
}
function checkstr3($str) {
	return preg_match("/[^0-9_]+$/", $str);
}
$str = "aaa111_汉字";
var_dump(checkstr($str),checkstr2($str),checkstr3($str));