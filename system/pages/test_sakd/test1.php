<?php 	
	
	require_once 'mysql_connect.php';
	
	$query = "SELECT id_program,nama_program FROM program WHERE Periode=2019 AND Perubahan=0";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
                'id_program'=>$row['id_program'], 
				'description'=>$row['nama_program']
             ) 
        );
    }
    echo json_encode($response);   
	
	 
	 
	
	
   