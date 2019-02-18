<?php 

	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
	
	include "mysql_connect.php";
	
	$id    = $_POST['counter']; //id
	$loket = $_POST['loket']; // counter	
	//$id    = 11;
	//$loket = 16;
	
	
	/*SQL SERVER*/	
	/*	
	$SQL=" select status from data_antrian where id='.$id.' and counter='.$loket.' ";
	$mRs = mssql_query($SQL);
	$mRo = mssql_fetch_array($mRs);
	$tRo = mssql_num_rows($mRs);
	if ($tRo>0){		
		//-->echo json_encode(array('huft' => $mRo[0]));		
	}
	mssql_close($ConSA);
	*/
	
	/*MYSQL SERVER*/		
	
	$hasil = $mysqli->query('select * from data_antrian_baru where id='.$id.' and counter='.$loket.$filter_waktu.'');		
	$data = $hasil->fetch_array();
	echo json_encode(array('huft' => $data['status']));
	include 'mysql_close.php';
	
?>