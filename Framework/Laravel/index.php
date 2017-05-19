<?php
//演示服务容器
//http://laravelacademy.org/post/769.html
include_once './Superman.php';
include_once './XPower.php';
include_once './UltraBomb.php';

class Container {

	protected $binds;
	protected $instances;

	public function bind($abstract, $concrete) {
		if ($concrete instanceof Closure) {
			$this->binds[$abstract] = $concrete;
		} else {
			$this->instances[$abstract] = $concrete;
		}
	}

	public function make($abstract, $parameters = array()) {
		if (isset($this->instances[$abstract])) {
			return $this->instances[$abstract];
		}
		$parameters = (array)$parameters;
		array_unshift($parameters, $this);

		return call_user_func_array($this->binds[$abstract], $parameters);
	}

}

// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 向该 超级工厂 添加 超人 的生产脚本
$container->bind('superman', function($container, $moduleName) {
	return new Superman($container->make($moduleName));
});

// 向该 超级工厂 添加 超能力模组 的生产脚本
$container->bind('xpower', function($container) {
	return new XPower;
});

// 同上
$container->bind('ultrabomb', function($container) {
	return new UltraBomb;
});

$superman_1 = $container->make('superman', 'xpower');
$superman_2 = $container->make('superman', 'ultrabomb');
$superman_3 = $container->make('superman', 'xpower');
var_dump($superman_1,$superman_2,$superman_3,$container);