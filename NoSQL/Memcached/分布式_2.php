<?php

/**
 * Memcached 完整的可移植分布式方案
 * 一致性Hash分布
 * 服务器数量不发生变化的时候，普通Hash分布可以很好的运作。
 * 但增加或减少一台服务器时，同一个key的hash值与服务器数量的取模会发生变化，导致之前保存的数据丢失。
 * 一致性Hash分布算法可以减少数据的丢失
 */
//三台服务器配置
$memconfig = array(
	array('host' => '127.0.0.1', 'port' => 11211),
	array('host' => '127.0.0.1', 'port' => 11212),
	array('host' => '127.0.0.1', 'port' => 11213)
);

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

//一致性Hash算法
class Flexihash {

	var $serverList = array();
	var $isSorted = FALSE;

	function addServer($server) {
		$hash = myHash(implode(':', $server));
		if (!isset($this->serverList[$hash])) {
			$this->serverList[$hash] = $server;
			$this->isSorted = FALSE;
		}
		return true;
	}

	function rmServer($server) {
		$hash = myHash(implode(':', $server));
		if (isset($this->serverList[$hash])) {
			unset($this->serverList[$hash]);
		}
		return true;
	}

	function lookUp($key) {
		if (!$this->isSorted) {
			ksort($this->serverList, SORT_NUMERIC);
			$this->isSorted = TRUE;
		}
		$hash = myHash($key);
		foreach ($this->serverList as $pos => $config) {
			if ($pos >= $hash) {
				return $config;
			}
		}
		reset($this->serverList);
		return current($this->serverList);
	}

	function memServer($func, $key, $param = array(), &$position = null) {
		$server = $this->lookUp($key);
		$position = implode(":", $server);
		$mem = new Memcache();
		$mem->connect($server['host'], $server['port']);
		return call_user_func_array(array($mem, $func), array_merge(array($key), $param));
	}

}

//使用示例
$finder = new Flexihash();
$finder->addServer($memconfig[0]);
$finder->addServer($memconfig[1]);
$finder->addServer($memconfig[2]);
$arr = array();
for ($i = 0; $i < 1000; $i++) {
	$memKey = "Test_{$i}";
	$memVal = $i;
	$finder->memServer('set', $memKey, array($memVal), $poi);
	$a = $finder->memServer('get', $memKey);
	$arr[$poi][] = $memKey." ".$a;
}
var_dump($arr);
