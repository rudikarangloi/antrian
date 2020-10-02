<?php 
		session_start();
		
		include "mysql_connect.php";
		$data = array();
		$date = date("Y-m-d");
		$filter_jenis_antrian = " AND jenis_antrian_poliklinik <> '0' ";	
				
		$loket = $_SESSION["nomor_loket"];;
		$sql_loket = " AND counter = ".$loket ;
		
		$data['jumlah_loket'] = 1;
		
		$sql = 'SELECT max(nomor) as nomor FROM data_antrian WHERE status=2 '. $sql_loket . $filter_waktu . $filter_jenis_antrian;
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
			$sql = 'SELECT * FROM data_antrian WHERE status=0 '. $sql_loket . $filter_waktu . $filter_jenis_antrian . ' ORDER BY waktu ASC LIMIT 1';
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