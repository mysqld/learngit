<?php
$con = new Mongo("localhost:27020");
$db = $con->selectDB("test");
$collection = $db->selectCollection("test");

$obj = array("master"=>'nihao');
$collection->insert($obj);

$alldoc = $collection->find();
foreach ($alldoc as $doc) {
	echo $doc["_id"] . " " . $doc["master"] . "<br />\n"; // 有的有 title 有的没有
}
$con->close();

