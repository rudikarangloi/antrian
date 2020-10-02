<?php

require_once 'connect.php';

 $query = "SELECT * FROM as_jobs ORDER BY Job_id AND status='Y'";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
            'job_id'=>$row['job_id'], 
            'job_name'=>$row['job_name']
            ) 
        );
    }
    
    $data['result'] = 'true';
    $data['msg'] = 'Login berhasil.';
	$data['data'] = $response;

    echo json_encode($data);  
?>