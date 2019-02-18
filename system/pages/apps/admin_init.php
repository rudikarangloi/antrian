<?php  
        //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
	
    	include "mysql_connect.php";
		
		/*SQL SERVER*/
		/*
		$SQL=" SELECT count(*) as count FROM client_antrian ";
		$mRs = mssql_query($SQL);
		$mRo = mssql_fetch_array($mRs);
		$tRo = mssql_num_rows($mRs);
		if ($tRo>0){			
			$count = $mRo[0];
			$jmlClient = $count;
		}else{			
			$jmlClient = 0;
		}
		mssql_close($ConSA);
		*/
		
		
		/*MYSQL SERVER*/
    	$rstClient = $mysqli->query('SELECT count(*) as count FROM client_antrian ');		
		$rowClient = $rstClient->fetch_array();
		if($rowClient['count']>0){
			$jmlClient = $rowClient['count'];
		}else{
			$jmlClient = 0;
		}
	    echo json_encode( array('client'=> $jmlClient) );
    	include 'mysql_close.php';
    