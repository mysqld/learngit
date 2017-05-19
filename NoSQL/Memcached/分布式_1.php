<?php

/**
 * Memcached 完整的可移植分布式方案
 * 普通Hash分布
 */

//三台服务器配置
$memconfig = array(
	array('host' => '127.0.0.1', 'port' => 11211),
	array('host' => '127.0.0.1', 'port' => 11212),
	array('host' => '127.0.0.1', 'port' => 11213)
);

//测试连接
$mem1 = new Memcache();
$mem1->connect($memconfig[0]['host'], $memconfig[0]['port']);
$mem2 = new Memcache();
$mem2->connect($memconfig[1]['host'], $memconfig[1]['port']);
$mem3 = new Memcache();
$mem3->connect($memconfig[2]['host'], $memconfig[2]['port']);
$mem1->set('test', 1);
$val1 = $mem1->get('test');
$mem2->set('test', 2);
$val2 = $mem2->get('test');
$mem3->set('test', 3);
$val3 = $mem3->get('test');
var_dump($val1, $val2, $val3);die;

//设计哈希函数
function myHash($key) {
	$md5 = substr(md5($key), 0, 8);
	$seed = 33;
	$hash = 0;
	for ($i = 0; $i < 8; $i++) {
		$hash = $hash * $seed + ord($md5{$i});
	}
	return $hash & 0x7FFFFFFF;
}

//设计memcache服务器选择器
function memServer($func, $key, $param = array(), &$position = null) {
	global $memconfig;

	$position = $index = myHash($key) % 3;
	$mem = new Memcache();
	$mem->connect($memconfig[$index]['host'], $memconfig[$index]['port']);
	return call_user_func_array(array($mem, $func), array_merge(array($key), $param));
}

//录入数据测试分布是否均匀
for ($i = 0; $i < 10000; $i++) {
	$memkey = 'test_'.$i;
	$memval = $i;
	memServer('set', $memkey, array($memval), $poi);
	$arr[$poi][] = $memkey;
}

var_dump($arr);
