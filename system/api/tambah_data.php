<?php

//if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	
	require_once 'connect.php';
	
	//$loket  = $_POST['loket'];
	$loket  = 7;
	
	//
	$model_antrian = 0;
	$filter_waktu = " AND DATE(waktu) = CURDATE() ";
	
	/*
	if($model_antrian == 1){				
		$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE counter='".$loket."' ".$filter_waktu);
	}else{				
		$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE id ".$filter_waktu);	
	}
	*/
	
	
	$query = " SELECT count(*) as count FROM data_antrian WHERE id ".$filter_waktu ;
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
		
				
		if($row['count']>0){
			$jmlCountId = (int)$row['count'] + 1 ;
		}else{
			$jmlCountId = 1;
		}		
		   
    }
	
	/*
	$rowCountId = $rstCountId->fetch_array();
	if($rowCountId['count']>0){
		$jmlCountId = (int)$rowCountId['count'] + 1 ;
	}else{
		$jmlCountId = 1;
	}
	*/
	
	
	$waktu    = date("Y-m-d H:i:s");
	$status   = '3';
		
				
	//
	
	$sql = "INSERT INTO data_antrian SET 
	            counter = '$loket',
	            waktu   = '$waktu',
	            status  = '$status',	           
				nomor   = '$jmlCountId'
				";
	
	if(mysqli_query($conn,$sql)){
		echo $jmlCountId;
	}else{
		echo "Gagal Insert Data";	
	}
//}



?>