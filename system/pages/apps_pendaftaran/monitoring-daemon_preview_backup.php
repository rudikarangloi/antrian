<?php 
		session_start();
		
		include "mysql_connect.php";
		$data = array();
		$date = date("Y-m-d");		
		
		
		$results = $mysqli->query('SELECT  count(*) as jumlah_loket FROM client_antrian');	
		$loket = $results->fetch_array();
		$data['jumlah_loket'] = $loket['jumlah_loket']; // set jumlah loket
		
		$client = $mysqli->query('SELECT client From client_antrian'); // execution
		while ($cl = $client->fetch_array()) {			
			
			$sql = 'SELECT max(id) as id FROM data_antrian WHERE counter ='. $cl['client'] .' and status=2 '.$filter_waktu
			$rst = $mysqli->query($sql); // execution
			$row = $rst->fetch_array();
			if ($row['id']==NULL) {
				$id=0;
			} else {
				$id=$row['id'];
			}
			$data["init_counter"][$cl['client']] = $id; // inisial setiap loket	
						
		
		}
		
		$sql = "";
		$result = $mysqli->query('SELECT id, counter FROM data_antrian WHERE status=2 '. $sql . $filter_waktu .' ORDER BY waktu DESC LIMIT 1'); // execution
		$rows = $result->fetch_array();
		if($rows['id']!=NULL)
		{
			$data['next'] = $rows['id'];	
			$data['counter'] = $rows['counter'];
			// set wait
			$_SESSION["next_server"][$rows['counter']] = $rows['id'];
			$_SESSION["counter_server"][$rows['counter']] = $rows['counter'];			
		}
		
		echo json_encode($data);
		include 'mysql_close.php';
	
?>