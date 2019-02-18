<?php 
	session_start();
	
	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
	
	include "mysql_connect.php";
	
	
	/*SQL SERVER*/		
	/*
	$nSQ = " SELECT client From client_antrian ";
	$nRs = mssql_query($nSQ);
	while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))
	{
		$client = $mRo[0];
				
		$SQL=" SELECT max(id) as id FROM data_antrian WHERE counter =. $client . and status=2 ";
		$mRs = mssql_query($SQL);
		$mRo = mssql_fetch_array($mRs);
		$tRo = mssql_num_rows($mRs);
		if ($tRo>0){		
			$id=$mRo[0];
		}else{
			$id=0;
		}
		$_SESSION["next_server"][$client] = $id;
		$_SESSION["counter_server"][$client] = $client;
	}
	mssql_close($ConSA);
	*/
	
	/*MYSQL SERVER*/	
	$result = $mysqli->query('SELECT client From client_antrian'); // execution
	while ($rows = $result->fetch_array()) {
			$rst = $mysqli->query('SELECT max(id) as id FROM data_antrian WHERE counter ='. $rows['client'] .' and status=2 '.$filter_waktu.''); // execution
			$row = $rst->fetch_array();
			if ($row['id']==NULL)
				$id=0;
			else
				$id=$row['id'];
			$_SESSION["next_server"][$rows['client']] = $id;
			$_SESSION["counter_server"][$rows['client']] = $rows['client'];
		}
		include 'mysql_close.php';
	
?>