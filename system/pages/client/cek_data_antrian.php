<?php
//require "connfile-php7.php";
require "functionfile-php7.php";
include "../apps/mysql_connect.php";

extract($_POST);
extract($_GET);

//if(isset($_POST['input_data'])){
if(isset($_GET['input_data'])){
	
			
		$filter_waktu   = " AND DATE(antrianDate) = CURDATE()  " ;	

		$status_datang  = " AND status_kedatangan <> 1  " ;
		
		$sql = "SELECT data_antrian_detail.*,nama AS FldD FROM data_antrian_detail WHERE nik = '". $input_data ."'" . $filter_waktu;	
		 
		
		$sql = "SELECT data_antrian_detail.*,data_antrian_detail.nama AS FldD, client_antrian.kode_layanan,client_antrian.description 
				FROM data_antrian_detail 
				INNER JOIN data_antrian ON data_antrian_detail.kodeBooking = data_antrian.kodebooking
				INNER JOIN client_antrian ON data_antrian.counter = client_antrian.client
				WHERE data_antrian_detail.nik = '". $input_data ."'" . $filter_waktu . $status_datang;		
		
		$rstClient = $mysqli->query($sql);			
    	$rowClient = $rstClient->fetch_array();
    	if($rowClient['nik']){
			$json['peringatan'] = 0;
			$json['nama'] = $rowClient['FldD'];
			$nama = $json['nama'];
			$json['data'] = $rowClient;
			
			
			//echo json_encode($json['data']);
			//Update tabel data_antrian_detail.status_kedatangan = 1
			//$results = $mysqli->query("UPDATE data_antrian_detail SET status_kedatangan = 1 WHERE nik = '". $input_data ."'" . $filter_waktu);
			
			//$api_url = 'http://localhost:8090/sql_server_develop/konfirmasi_antrian.php?input_data='.http_build_query(json_encode($json['data']));
			$api_url = 'http://localhost:8090/sql_server_develop/konfirmasi_antrian.php?'.http_build_query($json['data']);
			
			$json_data = file_get_contents($api_url);
			header("location:form_scan_qr.php?peringatan=2&nama=$nama");
		}else{
			header("location:form_scan_qr.php?peringatan=1");
		}     

		
}

//echo json_encode($json);
?>

