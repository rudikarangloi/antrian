<?php
	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
		
	include "mysql_connect.php";
	include "print_tiket.php";	
	date_default_timezone_set('Asia/Jakarta');	
		
	$loket    = $_POST['loket'];
	$nomor_rm = $_POST['nomor_rm'];
	$counter  = "";
	
	//echo $loket .'  -- '.$nomor_rm;
	//exit;
	
	
	/*SQL SERVER*/
	/*
	
	$status = "3";
	
	$SQL="SELECT TOP 3 counter,status FROM data_antrian WHERE counter='' AND status=3 ";
	$mRs = mssql_query($SQL);
	$mRo = mssql_fetch_array($mRs);
	$tRo = mssql_num_rows($mRs);
	if ($tRo>0){			
			$id = $mRo[0];
			$SQL ="UPDATE data_antrian SET counter=". $loket .",status=0 WHERE id=".$id."";
			$Rs = mssql_query($SQL);
			$next_counter = $id;
	}else{
			$waktu = date("Y-m-d H:i:s");
			$status = "3";
			
			$gTBL = "data_antrian";
			$gFLD = "";
			$gVAL = "";
			$gFLD = "waktu";
			$gVAL = "'$waktu'";			
			$gFLD.= ", counter";
			$gVAL.= ", $loket";			
			$gFLD.= ", status";
			$gVAL.= ", $status";

			InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
			
			$data['idle'] = "TRUE";
	}
	
	mssql_close($ConSA); 
	*/
	
				
	/*MYSQL SERVER*/
	$rstClient = $mysqli->query("SELECT * FROM data_antrian_baru WHERE counter='' AND status=3 ".$filter_waktu." LIMIT 1");	
	$rowClient = $rstClient->fetch_array();
	if($rowClient['id']){
	//if(count($rowClient)>0){
			$id = $rowClient['id'];
			$results = $mysqli->query('UPDATE data_antrian_baru SET counter='.$loket.', status=0 WHERE id='.$id.'');
			$next_counter = $id;
			//update
	}else{
			if($model_antrian == 1){
				//Jika nomor antrian per loket
				$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian_baru WHERE counter='".$loket."' ".$filter_waktu);
			}else{
				//Jika nomor antrian tidak per loket
				$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian_baru WHERE id ".$filter_waktu);	
			}
           
			$rowCountId = $rstCountId->fetch_array();
			if($rowCountId['count']>0){
				$jmlCountId = (int)$rowCountId['count'] + 1 ;
			}else{
				$jmlCountId = 1;
			}
			//insert
			
		
			$results = $mysqli->query('INSERT INTO data_antrian_baru (waktu,counter,status,nomor) VALUES ("'.date("Y-m-d H:i:s").'",'.$loket.',3,'.$jmlCountId.')');
			
			//Cetak Nomor antrian
				
			$result = $mysqli->query('SELECT description FROM client_antrian_baru ORDER BY client'); 
			while ($rows = $result->fetch_array()) {	
				$NmArr[] = $rows['description'];
			}
			
			$val_loket = intval($loket) - 1;	
			$nama_loket= $NmArr[$val_loket];	
	
			cetak_nomor_antrian($jmlCountId, $nama_loket,$nomor_rm,'MyPrinterIS-HP');
			
			//----
			
			
			if($model_antrian == 1){
				//Jika nomor antrian per loket
				$rstCountId = $mysqli->query('SELECT count(*) as count FROM data_antrian_baru WHERE counter='.$loket.''.$filter_waktu);
			}else{
				//Jika nomor antrian tidak per loket
				$rstCountId = $mysqli->query('SELECT count(*) as count FROM data_antrian_baru WHERE id '.$filter_waktu);
			}

			$rowCountId = $rstCountId->fetch_array();
			if($rowCountId['count']>0){
				$jmlCountId = $rowCountId['count'];
			}else{
				$jmlCountId = 0;
			}
			//----
			//$next_counter = $mysqli->insert_id;
			$next_counter = $jmlCountId ;
			$data['idle'] = "TRUE";
	}
	//$results = $mysqli->query('INSERT INTO data_antrian (counter,waktu,status) VALUES ('.$loket.',"'.date("Y-m-d H:i:s").'",0)');
	$data['next'] = $next_counter;
	echo json_encode($data);
	include 'mysql_close.php';
	
?>