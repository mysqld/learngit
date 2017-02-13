<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$input_array = '';//array('First' => 1, 'Second' => 2);
//$result = array_change_key_case($input_array);
//var_dump($result);

$keys = array('a', 'b');
$values = array(1,2);
var_dump(@array_combine($keys, $values));