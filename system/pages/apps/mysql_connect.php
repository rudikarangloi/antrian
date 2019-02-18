<?php
	/*
	define('MyHostnameSA','localhost');
	define('MyDatabaseSA','antrian');
	define('MyUsernameSA','root');
	define('MyPasswordSA','root');
	define('MyPortSA','3306');

	$ConSA = mysqli_connect(MyHostnameSA, MyUsernameSA, MyPasswordSA, MyDatabaseSA, MyPortSA);
	*/
	$mysqli = @new mysqli('localhost', 'root', 'root', 'antrian',3306);
	//$mysqli = @new mysqli(MyHostnameSA, MyUsernameSA, MyPasswordSA, MyDatabaseSA, MyPortSA);
	if ($mysqli->connect_errno) {
	    die('Connect Error: ' . $mysqli->connect_errno);
	}
	
	date_default_timezone_set("Asia/Jakarta");
	$filter_waktu = " AND DATE(waktu) = CURDATE() ";
	$model_antrian = 0;
	//Jika nomor antrian per loket : model_antrian = 1, artinya nomor tidak bersambung. antar poli punya nomor antrian sendiri
	//Jika nomor antrian Tidak per loket : model_antrian = 0
	
	
	
?>