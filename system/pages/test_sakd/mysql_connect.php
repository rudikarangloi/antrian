<?php
	
	
	define('host','localhost');
	define('name', 'root');
	define('pass', 'root');
	define('dbase', 'SAPBDMLWNEW2_2019');

	$conn = mysqli_connect(host, name, pass, dbase) or die('Unable to connect');
	
	
	
?>