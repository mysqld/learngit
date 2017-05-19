<?php
$time1 = microtime(true);
$con = new Mongo("localhost:27020");
$db = $con->selectDB("testdb");
$collection = $db->selectCollection("table1");

for($i=200001; $i<=300000; $i++){
	$collection->insert(array("id"=>$i,"test"=>"test"));
}
$con->close();
$time2 = microtime(true);
echo $time2-$time1;

