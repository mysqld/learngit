<?php

$arr = array(1, 43, 54, 62, 21, 66, 32, 78, 36, 76, 39);

function getpao($arr) {
	$len = count($arr);
	//设置一个空数组 用来接收冒出来的泡
	//该层循环控制 需要冒泡的轮数
	for ($i = 1; $i < $len; $i++) { //该层循环用来控制每轮 冒出一个数 需要比较的次数
		for ($k = 0; $k < $len - $i; $k++) {
			if ($arr[$k] > $arr[$k + 1]) {
				$tmp = $arr[$k + 1];
				$arr[$k + 1] = $arr[$k];
				$arr[$k] = $tmp;
			}
		}
		
		echo $arr[$i]."\t\t\t\t";
			for($mm=0; $mm<$len; $mm++){
				echo $arr[$mm]."\t";
			}
			echo "<br />";
		
	}
	return $arr;
}

var_dump(getpao($arr));
