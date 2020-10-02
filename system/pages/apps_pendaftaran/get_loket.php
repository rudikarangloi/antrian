<?php 

	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
	
	include "mysql_connect.php";
	
	$data = array();
	
	/*SQL SERVER*/
	/*
	$nSQ = " SELECT DISTINCT(counter) as counter FROM data_antrian ";
	$nRs = mssql_query($nSQ);
	while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))
	{
		$counter = $mRo[0];				
		//-->$data[] = $counter;
	}
	mssql_close($ConSA);
	*/
	
	
	/*MYSQL SERVER*/
    
	$results = $mysqli->query('SELECT DISTINCT(counter) as counter FROM data_antrian WHERE id '.$filter_waktu);
	if ( $results->numColumns()) {
			while ($row = $results->fetch_array()) {
			    $data[] = $row['counter'];
			}
		}
	echo json_encode($data);
	include 'mysql_close.php';
   