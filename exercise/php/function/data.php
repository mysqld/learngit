<?php

/*
 * 数据验证格式化
 */

/**
 * http://localhost/source/PHP/function/data.php null
 * http://localhost/source/PHP/function/data.php?email=1111111 false
 * http://localhost/source/PHP/function/data.php?email=1111111@qq.com 1111111@qq.com
 */
$v_result = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
if ($v_result) {
	var_dump('email', $v_result);
} else {
	var_dump('fail', $v_result);
}

