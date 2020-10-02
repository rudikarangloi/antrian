<?php
	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";

	include "mysql_connect.php";
	
	/*SQL SERVER*/
	/*
	$SQL ='TRUNCATE TABLE data_antrian';
	$Rs = mssql_query($SQL);
	*/
	//-->echo json_encode( array('status'=> "Data Berhasil di Reset") );
	
	
	
	/*MYSQL SERVER*/
	
	//$rstClient = $mysqli->query('TRUNCATE TABLE data_antrian');
    echo json_encode( array('status'=> "Data Berhasil di Reset") );
	include 'mysql_close.php';
