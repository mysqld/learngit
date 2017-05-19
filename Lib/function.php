<?php
/**
 * fgets 文件转数组
 * @param string $filename 必选。文件绝对路径
 * @param int $strlen 可选。规定要读取的字节数。默认是 1024 字节
 * @return array
 */
function f2arr($filename, $strlen = 1024) {
	$result = array();
	$handle = fopen($filename, "r");
	while ($line = fgets($handle, $strlen)) {
		$result[] = trim($line);
	}
	fclose($handle);
	return $result;
}
