<?php

/*
 * 3. 选择排序—简单选择排序（Simple Selection Sort）
 */

//从一组数中选出最小值
function selectMinKey($arr, $n, $i) {
	$min = $arr[$i];
	$minkey = $i;
	$j = $i + 1;
	for ($j; $j < $n; $j++) {
		if ($arr[$j] < $min) {
			$min = $arr[$j];
			$minkey = $j;
		}
	}
	return $minkey;
}

//选择排序
function selectSort(&$arr, $n) {
	for ($i = 0; $i < $n; $i++) {
		$minkey = selectMinKey($arr, $n, $i);
		if ($minkey != $i) {
			$tmp = $arr[$i];
			$arr[$i] = $arr[$minkey];
			$arr[$minkey] = $tmp;
		}
	}
}

$arr = array(3, 1, 5, 7, 2, 4, 9, 6);
selectSort($arr, count($arr));
var_dump($arr);

/**
 *  简单选择排序的改进——二元选择排序
 *  简单选择排序，每趟循环只能确定一个元素排序后的定位。我们可以考虑改进为每趟循环确定两个元素（当前趟最大和最小记录）的位置,从而减少排序所需的循环次数。
 *  改进后对n个数据进行排序，最多只需进行[n/2]趟循环即可。具体实现如下：
 */
function selectSort2(&$r, $n) {
	for ($i = 1; $i <= $n/2; $i++) {
		// 做不超过n/2趟选择排序   
		$min = $i;
		$max = $i; //分别记录最大和最小关键字记录位置  
		for ($j = $i + 1; $j <= $n - $i; $j++) {
			if ($r[$j] > $r[$max]) {
				$max = $j;
				continue;
			}
			if ($r[$j] < $r[$min]) {
				$min = $j;
			}
		}
		//该交换操作还可分情况讨论以提高效率  
		$tmp = $r[$i - 1]; $r[$i - 1] = $r[$min]; $r[$min] = $tmp;
		$tmp = $r[$n - $i]; $r[$n - $i] = $r[$max]; $r[$max] = $tmp;
	}
}

$arr = array(3, 1, 5, 7, 2, 4, 9, 6);
selectSort2($arr, count($arr));
var_dump($arr);
