<?php
	ini_set('display_errors', '0');
	/*
	require "../../php/connfile.php";
	require "../../php/functionfile.php";
	require "../../php/insertupdate.php";
	*/
	include "mysql_connect.php";
	
    $id = $_POST['id'];
	
	
	/*SQL SERVER*/
	/*
	$SQL ="UPDATE data_antrian SET status= 2 WHERE id=".$id."";
	$Rs = mssql_query($SQL);
	if (!$Rs)
		//-->echo json_encode(array('status'=>0));
	else
		//-->echo json_encode(array('status'=>1));

	mssql_close($ConSA);
	*/
   
   
   
   
   
	/*MYSQL SERVER*/
	$result = $mysqli->query("UPDATE data_antrian_apotik SET status= 2,status_error='' WHERE id=".$id.""); 
	if (!$result)
		echo json_encode(array('status'=>0));
	else
		echo json_encode(array('status'=>1));
	
	include 'mysql_close.php';
	
