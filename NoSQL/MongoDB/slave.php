<?php
$con = new Mongo("localhost:27021");
$db = $con->selectDB("test");
$collection = $db->selectCollection("test");

$alldoc = $collection->find();
foreach ($alldoc as $doc) {
	echo $doc["_id"] . " " . $doc["master"] . "<br />\n"; // 有的有 title 有的没有
}
$con->close();

