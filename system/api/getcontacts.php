<?php 

require_once 'connect.php';

if(isset($_GET['item_type'])){
	$type = $_GET['item_type'];
}
if(isset($_GET['individu_id'])){
	$individu_id = $_GET['individu_id'];
}


if (isset($individu_id)) {
    
    $query = "SELECT * FROM as_individu WHERE individu_id = '$individu_id'";
    $result = mysqli_query($conn, $query);
    $response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        array_push($response, 
        array(
            'individu_id'=>$row['individu_id'], 
            'no_induk'=>$row['no_induk'], 
            'full_name'=>$row['full_name'], 
            'hp'=>$row['hp'], 
            'side_job'=>$row['side_job'],
            'image'=>$row['image']
            ) 
        );
    }
    echo json_encode($response);   
}
    
else {
    
    if (isset($_GET['key'])) {
        $key = $_GET["key"];
        if ($type == 'users') {
            $query = "SELECT * FROM as_individu WHERE full_name LIKE '%$key%'";
            $result = mysqli_query($conn, $query);
            $response = array();
            while( $row = mysqli_fetch_assoc($result) ){
                array_push($response, 
                array(
                    'individu_id'=>$row['individu_id'], 
                    'no_induk'=>$row['no_induk'], 
                    'full_name'=>$row['full_name'], 
                    'hp'=>$row['hp'], 
                    'side_job'=>$row['side_job'],
                    'image'=>$row['image']
                    ) 
                );
            }
            echo json_encode($response);   
        }
    } else {
        if ($type == 'users') {
            $query = "SELECT * FROM as_individu ORDER BY job_id";
            $result = mysqli_query($conn, $query);
            $response = array();
            while( $row = mysqli_fetch_assoc($result) ){
                array_push($response, 
                array(
                    'individu_id'=>$row['individu_id'], 
                    'no_induk'=>$row['no_induk'], 
                    'full_name'=>$row['full_name'], 
                    'hp'=>$row['hp'], 
                    'side_job'=>$row['side_job'],
                    'image'=>$row['image']
                    ) 
                );
            }
            echo json_encode($response);   
        }
    }
   
   
   
}

mysqli_close($conn);

?>