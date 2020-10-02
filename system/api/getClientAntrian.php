<?php 

require_once 'connect.php';


if(isset($_GET['item_type'])){
	$type = $_GET['item_type'];
}
if(isset($_GET['client'])){
	$client = $_GET['client'];
}


if (isset($client)) {
    
    $query = "SELECT * FROM client_antrian WHERE client = '$client'";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
            'client'=>$row['client'], 
            'description'=>$row['description'], 
            'kode_layanan'=>$row['kode_layanan']
            ) 
        );
    }
    echo json_encode($response);   
}
    
else {
    
    if (isset($_GET['key'])) {
        $key = $_GET["key"];
        if ($type == 'users') {
            $query = "SELECT * FROM client_antrian WHERE description LIKE '%$key%'";
            $result = mysqli_query($conn, $query);
            $response = array();
            while( $row = mysqli_fetch_assoc($result) ){
                array_push($response, 
                array(
                    'client'=>$row['client'], 
					'description'=>$row['description'], 
					'kode_layanan'=>$row['kode_layanan']
                    ) 
                );
            }
            echo json_encode($response);   
        }
    } else {
		
		//if(isset($type)){
			$query = "SELECT * FROM client_antrian ORDER BY id";
            $result = mysqli_query($conn, $query);
            $response = array();
            while( $row = mysqli_fetch_assoc($result) ){
                array_push($response, 
                array(
                    'client'=>$row['client'], 
					'description'=>$row['description'], 
					'kode_layanan'=>$row['kode_layanan']
                    ) 
                );
            }
            echo json_encode($response);   
		//}

       
    }
   
   
   
}

mysqli_close($conn);

?>