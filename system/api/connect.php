<?php 

define('host','localhost');
define('name', 'root');
define('pass', 'root');
define('dbase', 'antrian');

$conn = mysqli_connect(host, name, pass, dbase) or die('Unable to connect');

?>