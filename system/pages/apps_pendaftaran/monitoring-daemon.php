<?php 
		session_start();
		/*
		require "../../php/connfile.php";
		require "../../php/functionfile.php";
		require "../../php/insertupdate.php";
	*/
		include "mysql_connect.php";
		$data = array();
		$date = date("Y-m-d");
		
		
		/*SQL SERVER*/
		/*
		$SQL=" SELECT  count(*) as jumlah_loket FROM client_antrian ";
		$mRs = mssql_query($SQL);
		$mRo = mssql_fetch_array($mRs);
		$tRo = mssql_num_rows($mRs);
		if ($tRo>0){
			$jumlah_loket = $mRo[0];
			$data['jumlah_loket'] = $jumlah_loket; // set jumlah loket		
		}		
		
		$nSQ = "SELECT client From client_antrian";		
		$nRs = mssql_query($nSQ);
		while ($mRo = mssql_fetch_array($nRs, MYSQL_BOTH))
		{
			$client = $mRo[0];
			
			$SQL2 = " SELECT max(id) as id FROM data_antrian WHERE counter = ". $client ." and status=2 ";			
			$mRs2 = mssql_query($SQL2);
			$mRo2 = mssql_fetch_array($mRs2);
			$tRo2 = mssql_num_rows($mRs2);
			if($mRo2[0]==NULL){
				$id  = "NULL";
			}else{
				$id  = $mRo2[0];				
			}
			$data["init_counter"][$client] = $id; // inisial setiap loket		
			
		}		
					
		
		//STATUS
		//======
		//2 done
		//1 wait
		//0 execution
		$SQL = " SELECT count(*) as count FROM data_antrian WHERE status=1 ";
		$mRs = mssql_query($SQL);
		$mRo = mssql_fetch_array($mRs);
		$tRo = mssql_num_rows($mRs);
		if ($tRo>0){
			$count  = $mRo[0];	
						
		}else{
			// waktu perlu di casting ???
			$SQL = " SELECT TOP 1 id, counter FROM data_antrian WHERE status=0 ORDER BY convert(smalldatetime ,convert(varchar(10),waktu,103), 103) ASC  ";
			$mRs = mssql_query($SQL);
			$mRo2 = mssql_fetch_array($mRs);
			$tRo2 = mssql_num_rows($mRs);
			if ($tRo2>0){
				$id  = $mRo2[0];
				$counter  = $mRo2[1];				

				$data['next'] = $id;	
				$data['counter'] = $counter;
				// set wait
				$_SESSION["next_server"][$counter] = $id;
				$_SESSION["counter_server"][$counter] = $counter;
				
				$SQLu =" UPDATE data_antrian SET status= 1 WHERE id=".$id.""; // update to wait 1
				$Rsu = mssql_query($SQLu);						
			}
		}
		//-->echo json_encode($data);	
		
		
		
		
		mssql_close($ConSA);
		
		*/
		
		/*MYSQL SERVER*/
		// Jumlah Loket
		
		//## 1. Dapatkan Jumlah Loket
		/*
		$results = $mysqli->query('SELECT  count(*) as jumlah_loket FROM client_antrian');	
		$loket = $results->fetch_array();
		$data['jumlah_loket'] = $loket['jumlah_loket']; // set jumlah loket
				
		//## 2. Buat perulangan,ada berapa Loket
		$client = $mysqli->query('SELECT client From client_antrian'); // execution
		while ($cl = $client->fetch_array()) {
			
			//## 3. Ambil id tertinggi berdasar counter dan status=2 [status 2 = client yg sudah selesai ditangani]
			$rst = $mysqli->query('SELECT max(id) as id FROM data_antrian WHERE counter ='. $cl['client'] .' and status=2'); // execution
			$row = $rst->fetch_array();
			if ($row['id']==NULL) {
				$id=0;
			} else {
				$id=$row['id'];
			}
			$data["init_counter"][$cl['client']] = $id; // inisial setiap loket
			
			//ex: 
			//$data["init_counter"][1] = 0;
			
			//$data["init_counter"][2] = 4;
			//$data["init_counter"][3] = 1;
			
		}
		*/
		
		
		//STATUS
		//======
		//2 done
		//1 wait
		//0 execution
		/*
		$data['jumlah_loket']    = 1
		$data["init_counter"][1] = 0;
		$data['next']            = 1
		$data['counter']         = 1
		
		$_SESSION["next_server"][1]    = 1;
		$_SESSION["counter_server"][1] = 1;
		*/
		
		$loket = $_SESSION["nomor_loket"];;
		$sql_loket = " AND counter = ".$loket ;
		
		$data['jumlah_loket'] = 1;
		
		$sql = 'SELECT max(nomor) as nomor FROM data_antrian WHERE status=2 '.$sql_loket.$filter_waktu;
		$rst = $mysqli->query($sql); // execution		
		$row = $rst->fetch_array();
		if ($row['nomor']==NULL) {
			$nomor=0;
		} else {
			$nomor=$row['nomor'];
		}
		$data["init_counter"][1] = $nomor; // inisial setiap loket
		
		//## 4. Cari banyak data di tabel data_antrian yg status = 1 [Tidak pernah ada]
		
			//# 5. cari data di tabel data_antrian yang status=0 [Klik dari Kasir / Admin]
			$sql = 'SELECT * FROM data_antrian WHERE status=0 '.$sql_loket.$filter_waktu.' ORDER BY waktu ASC LIMIT 1';
			//echo $sql."<P>";
			$result = $mysqli->query($sql ); // execution
			$rows = $result->fetch_array();
			if($rows['id']!=NULL)
			{
				$data['next']     = $rows['id'];	
				$data['counter']  = $rows['counter'];
				$data['nomor']    = $rows['nomor'];
				$data['tesangka'] = $rows['nomor'];
				
				// set wait
				$_SESSION["next_server"][$rows['counter']] = $rows['nomor'];
				$_SESSION["counter_server"][$rows['counter']] = $rows['counter'];
				//# 5. Tabel data_antrian di update status=1 
				$mysqli->query('UPDATE data_antrian SET status= 1 WHERE id='. $rows['id'] .''); // update to wait 1
			}
		
		echo json_encode($data);
		include 'mysql_close.php';
	
?>