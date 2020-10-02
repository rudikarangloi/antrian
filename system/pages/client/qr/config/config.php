<?php
$con = mysqli_connect(
	'localhost', 
	'root', 
	'root', 
	'test');

if(!$con){
	die("Database tidak ditemukan".mysqli_connect_error());
}

?>
