<?php 
		session_start();
		
		include "mysql_connect.php";
		$data = array();
		$date = date("Y-m-d");		
		
	
		$rst = $mysqli->query('SELECT max(nomor) as id FROM data_antrian_apotik WHERE status=2 '.$filter_waktu); // Nomor tertinggi
		$row = $rst->fetch_array();
		if ($row['id']==NULL) {
            $id=0;               
		} else {
            $id=$row['id'];              
		}
		$data["init_max_queque"] = $id; 
		
		
		$rst = $mysqli->query('SELECT COUNT(*) as id FROM data_antrian_apotik WHERE status '.$filter_waktu); // Jumlah Total antrian
		$row = $rst->fetch_array();
		if ($row['id']==NULL) {
            $id=0;               
		} else {
            $id=$row['id'];              
		}
		$data["init_count_queque"] = $id; 
		
				
		echo json_encode($data);
		include 'mysql_close.php';
	
?>