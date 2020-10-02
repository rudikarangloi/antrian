<?php 
	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";

	include "mysql_connect.php";
	
	$id = $_POST['counter']; //id
	$loket = $_POST['loket']; // counter
	
	/*SQL SERVER*/
	/*
	$SQL ='UPDATE data_antrian SET waktu="'.date("Y-m-d H:i:s").'",status=0 WHERE id='.$id.' and counter='.$loket.'';
	$Rs = mssql_query($SQL);
	
	$SQL=' select status from data_antrian where id='.$id.' and counter='.$loket.' ';
	$mRs = mssql_query($SQL);
	$mRo = mssql_fetch_array($mRs);
	$tRo = mssql_num_rows($mRs);
	if ($tRo>0){		
		//-->echo json_encode(array('huft' => $mRo[0]));       	
	}
	mssql_close($ConSA);
*/
	
	
	/*MYSQL SERVER*/
	$results = $mysqli->query('UPDATE data_antrian SET waktu="'.date("Y-m-d H:i:s").'",status=0 WHERE id='.$id.' and counter='.$loket.'');		
	$hasil = $mysqli->query('select * from data_antrian where id='.$id.' and counter='.$loket.$filter_waktu.'');	
	$data = $hasil->fetch_array();
	echo json_encode(array('huft' => $data['status']));
	include 'mysql_close.php';
	
?>