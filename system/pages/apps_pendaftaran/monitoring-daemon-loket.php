<?php 
	session_start();
	
		include "mysql_connect.php";
		$data = array();
		$date = date("Y-m-d");
		$filter_jenis_antrian = " AND jenis_antrian_poliklinik = '0' ";	
		// Jumlah Loket
		$results = $mysqli->query("SELECT  count(*) as jumlah_loket FROM loket_antrian ");	
		$loket = $results->fetch_array();
		$data['jumlah_loket'] = $loket['jumlah_loket']; // set jumlah loket
		$client = $mysqli->query('SELECT client From loket_antrian'); // execution
		while ($cl = $client->fetch_array()) {
			$rst = $mysqli->query('SELECT max(nomor) as id FROM data_antrian WHERE loket ='. $cl['client'] .' and status=2 '. $filter_waktu . $filter_jenis_antrian); // execution
			$row = $rst->fetch_array();
			if ($row['id']==NULL) {
                $id=0;               
			} else {
                $id=$row['id'];              
			}
			$data["init_counter"][$cl['client']] = $id; // inisial setiap loket
		}

		//STATUS
		//======
		//2 done
		//1 wait
		//0 execution
		$result_wait = $mysqli->query('SELECT count(*) as count FROM data_antrian WHERE status=1 '. $filter_waktu . $filter_jenis_antrian); // wait 1
		$wait = $result_wait->fetch_array();
		$count = $wait['count'];
		if ($count){
			//echo $count;
				
			$rst = $mysqli->query("SELECT * FROM data_antrian WHERE status=1 AND (ISNULL(status_error) OR status_error='') ". $filter_waktu . $filter_jenis_antrian . " ORDER BY waktu ASC LIMIT 1"); 
			$brs = $rst->fetch_array();
			if($brs['id']!=NULL)
			{				
				$mysqli->query("UPDATE data_antrian SET status= 0,status_error='1' WHERE id=". $brs['id'] .""); 	
			}
		
			
		}else{
			$result = $mysqli->query('SELECT * FROM data_antrian WHERE status=0 '. $filter_waktu . $filter_jenis_antrian .' ORDER BY waktu ASC LIMIT 1'); // execution
			$rows = $result->fetch_array();
			if($rows['id']!=NULL)
			{
				$data['next']     = $rows['id'];	
				//$data['next']     = $rows['nomor'];
				$data['counter']  = $rows['loket'];
				$data['nomor']    = $rows['nomor'];
				$data['tesangka'] = $rows['nomor'];
				// set wait
				$_SESSION["next_server"][$rows['counter']] = $rows['id'];
				//$_SESSION["next_server"][$rows['counter']] = $rows['nomor'];
				$_SESSION["counter_server"][$rows['counter']] = $rows['loket'];
				$mysqli->query("UPDATE data_antrian SET status= 1,status_error='1' WHERE id=". $rows['id'] .""); // update to wait 1
			}
		}
		echo json_encode($data);
		include 'mysql_close.php';
	
?>