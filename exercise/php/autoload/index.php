<?php
##########
# 阶段一 #
##########
/**
 * 1、如果类存在继承关系（例如：ClassB extends ClassA），并且ClassA不在ClassB所在目录
 * 利用__autoload魔术函数实例化ClassB的时候就会受到一个致命错误：
 * Fatal error: Class ‘Classd' not found in ……ClassB.php on line 2，
 * 解决方法：把所有存在extends关系的类放在同一个文件目录下，或者在实例化一个继承类的时候在文件中手工包含被继承的类；
 * 2、另外一个需要注意的是，类名和类的文件名必须一致，才能更方便的使用魔术函数__autoload；
 * 其他需要注意的事情：
 * 3、在CLI模式下运行PHP脚本的话这个方法无效；
 * 4、如果你的类名称和用户的输入有关——或者依赖于用户的输入，一定要注意检查输入的文件名，例如：.././这样的文件名是非常危险的。 

// __autoload的使用方法：自己写的
function __autoload($classname) {
	//字母数字下划线的限定
	//引用
	$file = './library/' . $classname . '.php';
	is_file($file) && require_once './library/' . $classname . '.php';
}
$b = new classB();
 */

##########
# 阶段二 #
##########
/*
// __autoload的使用方法1：来源于网络
// 最经常使用的就是这种方法，根据类名，找出类文件，然后require_one
// 这种方法的好处就是简单易使用。当然也有缺点，缺点就是将类名和文件路径强制做了约定，当修改文件结构的时候，就势必要修改类名。
function __autoload($classname) {
	$path = str_replace('_', '/', $classname);
	require_once $path . '.php';
}
$a = new Http_File_Interface();
 */

//__autoload的使用方法2（直接映射法）:来源于网络 推荐
define('ROOT_PATH', dirname(dirname(dirname(dirname(__FILE__)))));
$map = array(
	'classA' => ROOT_PATH . '/exercise/php/autoload/library/classA.php',
	'classB' => ROOT_PATH . '/exercise/php/autoload/library/classB.php',
);
function __autoload($classname) {
	global $map;
	if (isset($map[$classname])) {
		require_once $map[$classname];
	}
}
$a = new classA();
$b = new classB();
// 这种方法的好处就是类名和文件路径只是用一个映射来维护，所以当文件结构改变的时候，不需要修改类名，只需要将映射中对应的项修改就好了。
// 这种方法相较于前面的方法缺点是当文件多了的时候这个映射维护起来非常麻烦，或许这时候你就会考虑使用json或者单独一个文件来进行维护了。或许你会想到使用一个框架来维护或者建立这么一个映射。 

##########
# 阶段三 #
##########
// spl_autoload
// __autoload的最大缺陷是无法有多个autoload方法
// 好了， 想下下面的这个情景，你的项目引用了别人的一个项目，你的项目中有一个__autoload，别人的项目也有一个__autoload,这样两个__autoload就冲突了。解决的办法就是修改__autoload成为一个，这无疑是非常繁琐的。
// 因此我们急需使用一个autoload调用堆栈，这样spl的autoload系列函数就出现了。你可以使用spl_autoload_register注册多个自定义的autoload函数
// 如果你的PHP版本大于5.1的话，你就可以使用spl_autoload 
function __autoload_self1(){
	echo 111;
}
var_dump(spl_autoload_functions());
spl_autoload_register('__autoload_self1');
spl_autoload_register('__autoload');
var_dump(spl_autoload_functions());
spl_autoload_unregister('__autoload_self1');
var_dump(spl_autoload_functions());