<?php

/**
 * memcache 连接池
 */
//三台服务器配置
$memconfig = array(
	array('host' => '127.0.0.1', 'port' => 11211),
	array('host' => '127.0.0.1', 'port' => 11212),
	array('host' => '127.0.0.1', 'port' => 11213)
);

//测试连接
//$mem1 = new Memcache();
//$mem1->connect($memconfig[0]['host'], $memconfig[0]['port']);
//$mem2 = new Memcache();
//$mem2->connect($memconfig[1]['host'], $memconfig[1]['port']);
//$mem3 = new Memcache();
//$mem3->connect($memconfig[2]['host'], $memconfig[2]['port']);
//$mem1->set('test', 1);
//$val1 = $mem1->get('test');
//$mem2->set('test', 2);
//$val2 = $mem2->get('test');
//$mem3->set('test', 3);
//$val3 = $mem3->get('test');
//var_dump($val1, $val2, $val3);
//die;

$mem = new Memcache();
$mem->addserver($memconfig[0]['host'], $memconfig[0]['port']);
$mem->addserver($memconfig[1]['host'], $memconfig[1]['port']);
$mem->addserver($memconfig[2]['host'], $memconfig[2]['port']);
$mem->set('testkey', 125);
$memVal = $mem->get(testkey);
var_dump($memVal);die;
