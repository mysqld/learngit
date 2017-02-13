<?php

// spl_autoload
// __autoload的最大缺陷是无法有多个autoload方法
// 好了， 想下下面的这个情景，你的项目引用了别人的一个项目，你的项目中有一个__autoload，别人的项目也有一个__autoload,这样两个__autoload就冲突了。解决的办法就是修改__autoload成为一个，这无疑是非常繁琐的。
// 因此我们急需使用一个autoload调用堆栈，这样spl的autoload系列函数就出现了。你可以使用spl_autoload_register注册多个自定义的autoload函数
// 如果你的PHP版本大于5.1的话，你就可以使用spl_autoload

define('ROOT_PATH', dirname(dirname(dirname(dirname(__FILE__)))));

//实现1
function __autoload($classname) {
	$map = array(
		'classA' => ROOT_PATH . '/exercise/php/autoload/library/classA.php',
		'classB' => ROOT_PATH . '/exercise/php/autoload/library/classB.php',
	);
	if (isset($map[$classname])) {
		require_once $map[$classname];
	}
}

//实现二
function __autoload2($classname) {
	//字母数字下划线的限定
	//引用
	$file = ROOT_PATH . '/exercise/php/autoload/library_2/' . $classname . '.php';
	is_file($file) && require_once $file;
}

spl_autoload_register('__autoload2');
spl_autoload_register('__autoload');

new classA();
new classC();
