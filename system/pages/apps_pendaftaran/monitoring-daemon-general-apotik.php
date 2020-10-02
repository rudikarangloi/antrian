<?php 
	session_start();
	
		include "mysql_connect.php";
		$data = array();
		$date = date("Y-m-d");
		// Jumlah Loket
		$results = $mysqli->query('SELECT  count(*) as jumlah_loket FROM client_antrian_apotik');	
		$loket = $results->fetch_array();
		$data['jumlah_loket'] = $loket['jumlah_loket']; // set jumlah loket
		$client = $mysqli->query('SELECT client From client_antrian_apotik'); // execution
		while ($cl = $client->fetch_array()) {
			$rst = $mysqli->query('SELECT max(nomor) as id FROM data_antrian_apotik WHERE counter ='. $cl['client'] .' and status=2 '.$filter_waktu); // execution
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
		$result_wait = $mysqli->query('SELECT count(*) as count FROM data_antrian_apotik WHERE status=1'.$filter_waktu); // wait 1
		$wait = $result_wait->fetch_array();
		$count = $wait['count'];
		if ($count){
			//echo $count;
			$rst = $mysqli->query("SELECT * FROM data_antrian_apotik WHERE status=1 AND (ISNULL(status_error) OR status_error='') ".$filter_waktu." ORDER BY waktu ASC LIMIT 1"); 
			$brs = $rst->fetch_array();
			if($brs['id']!=NULL)
			{				
				$mysqli->query("UPDATE data_antrian_apotik SET status= 0,status_error='1' WHERE id=". $brs['id'] .""); 	
			}
		}else{
			$result = $mysqli->query('SELECT * FROM data_antrian_apotik WHERE status=0 '.$filter_waktu.' ORDER BY waktu ASC LIMIT 1'); // execution
			$rows = $result->fetch_array();
			if($rows['id']!=NULL)
			{
				$data['next']     = $rows['id'];	
				//$data['next']     = $rows['nomor'];
				$data['counter']  = $rows['counter'];
				$data['nomor']    = $rows['nomor'];
				$data['tesangka'] = $rows['nomor'];
				// set wait
				$_SESSION["next_server"][$rows['counter']] = $rows['id'];
				//$_SESSION["next_server"][$rows['counter']] = $rows['nomor'];
				$_SESSION["counter_server"][$rows['counter']] = $rows['counter'];
				$mysqli->query("UPDATE data_antrian_apotik SET status= 1,status_error='1' WHERE id=". $rows['id'] .""); // update to wait 1
			}
		}
		echo json_encode($data);
		include 'mysql_close.php';
	
?>