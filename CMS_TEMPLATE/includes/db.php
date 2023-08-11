<?php
ob_start();

$db['host']="localhost";
$db['user']='root';
$db['password']='';
$db['name']='cms';

foreach($db as $key => $val){
    define(strtoupper($key), $val);
}

$conn = mysqli_connect(HOST, USER, PASSWORD, NAME);
//$conn = mysqli_connect('localhost', 'root', '', 'cms');
if(!$conn){ echo "connection error"; }

// $query = "SET NAMES utf8";
// mysqli_query($cinn, $query);
 
?>