<?php 
		session_start();
		
		include "mysql_connect.php";
		$data  = array();
		$date  = date("Y-m-d");		
		$loket = $_POST['nomor_loket'];
		$sql_loket = " AND counter = ".$loket ;
		$filter_jenis_antrian = " AND jenis_antrian_poliklinik <> '0' ";		
	
		$rst = $mysqli->query('SELECT max(nomor) as id FROM data_antrian WHERE status=2 '. $sql_loket . $filter_waktu . $filter_jenis_antrian); // Nomor tertinggi
		$row = $rst->fetch_array();
		if ($row['id']==NULL) {
            $id=0;               
		} else {
            $id=$row['id'];              
		}
		$data["init_max_queque"] = $id; 
		
		
		$rst = $mysqli->query('SELECT COUNT(*) as id FROM data_antrian WHERE status '. $sql_loket . $filter_waktu. $filter_jenis_antrian); // Jumlah Total antrian
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