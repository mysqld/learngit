<?php

$con = new Mongo("localhost:27020");
$db = $con->selectDB("testdb");
$collection = $db->selectCollection("table1");

for($i=100001; $i<=200000; $i++){
	$collection->insert(array("id"=>$i,"test"=>"test"));
}
$con->close();

