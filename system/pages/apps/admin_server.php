<?php 
	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
		
		
	include "mysql_connect.php";
	$data = array();
	
	
	/*SQL SERVER*/
	/*
	if (isset($_POST) and count($_POST) > 0){
		if (isset($_POST['db']) and $_POST['db']=="queue") {
				$nSQ = " SELECT TOP 1 * FROM data_antrian ORDER BY id ASC ";
				$nRs = mssql_query($nSQ);
				while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))
				{					
					$data['id']      = $mRo[0];
					$data['counter'] = $mRo[1];
					$data['waktu']   = $mRo[2];
					$data['status']  = $mRo[3];
				}
				//-->echo json_encode($data);
		}else{
				$jmlloket = $_POST['jmlloket'];
				$SQL =" DELETE FROM client_antrian ";
				$Rs = mssql_query($SQL);	
				
				for ($i=1; $i <= $jmlloket ; $i++) { 
					$results = $mysqli->query('INSERT INTO client_antrian (client) VALUES ('.$i.')');
					$gTBL = "client_antrian";
					$gFLD = "";
					$gVAL = "";
					$gFLD = "client";
					$gVAL = "$i";				
				
					InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
				}
				//-->echo json_encode(array("status"=>TRUE));			
		}		
	}else{		
		$nSQ = " SELECT  count(*) as jumlah_loket FROM client_antrian ";
		$nRs = mssql_query($nSQ);
		while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))
		{
			$jumlah_loket  = $mRo[0];
			
			$data['jumlah_loket'] = $jumlah_loket;
		}
		//-->echo json_encode($data);		
	}
	
	mssql_close($ConSA);	
	*/
	
	
	
	/*MYSQL SERVER*/
	if (isset($_POST) and count($_POST) > 0){
		if (isset($_POST['db']) and $_POST['db']=="queue") {
			$results = $mysqli->query('SELECT * FROM data_antrian  WHERE id '.$filter_waktu.' ORDER BY id ASC LIMIT 1');
			while ($row = $results->fetch_array()) {
			    $data['id'] = $row['id'];
			    $data['counter'] = $row['counter'];
			    $data['waktu'] = $row['waktu'];
			    $data['status'] = $row['status'];
			}
			echo json_encode($data);	
		}else{
			$jmlloket = $_POST['jmlloket'];
			//$results = $mysqli->query('DELETE FROM client_antrian9;');
			//for ($i=1; $i <= $jmlloket ; $i++) { 
			//	$results = $mysqli->query('INSERT INTO client_antrian9 (client) VALUES ('.$i.')');
			//}
			echo json_encode(array("status"=>TRUE));		
		}
	} else {
		$results = $mysqli->query('SELECT  count(*) as jumlah_loket FROM client_antrian WHERE id '.$filter_waktu);	
		while ($row = $results->fetch_array()) {
		    $data['jumlah_loket'] = $row['jumlah_loket'];
		}
    	echo json_encode($data);
	}
	include 'mysql_close.php';
