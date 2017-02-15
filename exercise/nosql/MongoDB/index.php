<?php
//http://blog.csdn.net/ithomer/article/details/49449319
// 这里采用默认连接本机的 27017 端口，当然你也可以连接远程主机如 192.168.0.4:27017，如果端口是 27017，端口可以省略
$con = new Mongo();

// 选择 local 数据库，如果以前没该数据库会自动创建，也可以用 $db = $m->selectDB("local");
$db = $con->local;
//$db = $con->selectDB("local");

// 选择 local 里面的 startup_log 集合，相当于RDBMS里面的表，也可以用 $collection = $db->selectCollection("startup_log");
$collection = $db->startup_log;
//$collection = $db->selectCollection("startup_log");

// 将 $obj 添加到 $collection 集合中 
$doc = array("title" => "Calvin and Hobbes-" . date('Y-m-d H:i:s'), "author" => "Bill Watterson2");
$collection->insert($doc);

// 获取集合中的所有文档
$alldoc = $collection->find();
foreach ($alldoc as $doc) {
	echo $doc["title"] . " " . $doc["author"] . "<br />\n"; // 有的有 title 有的没有
}

######################
## CRUD 操作		##
######################
//$newdata = array('$set' => array("title" => "test@test.com")); // 更新 不管用
//$collection->update(array("author" => "Bill Watterson"), $newdata);

$user = $collection->findOne(array("author" => "Bill Watterson"), array('title')); //查找一条
$users = $collection->find(array("author" => "Bill Watterson"), array('title')); //查找多条
foreach ($users as $doc) {
	echo "new line" . $doc["title"] . " " . $doc["author"] . "<br />\n"; // 有的有 title 有的没有
}

//删除所有数据
//$collection->remove(); //不管用

// 删除 name 为 hm
//$collection->remove(array('name' => 'Bill Watterson2')); //不管用

//断开MongoDB连接
$con->close();

