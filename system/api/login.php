<?php 

require_once 'connect.php';

$data = array();

if(isset($_POST['userName']) && isset($_POST['password'])){
	$userName  = $_POST['userName'];
	$password  = md5($_POST['password']);
	
	$sql="SELECT * FROM users WHERE username = '$userName' AND password = '$password' AND blocked = 'N' AND status = 'Y'";
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0)	
	
	{
		$response = array();
		while( $row = mysqli_fetch_assoc($result) ){      
			
			$response =  array(
				'id'=>$row['id'], 
				'username'=>$row['username'], 
				'password'=>$row['password'], 
				'full_name'=>$row['full_name'], 
				'phone'=>$row['phone'], 
				'blocked'=>$row['blocked'], 				
				'status'=>$row['status']
				) ;
		}

		$data['result'] = 'true';
		$data['msg'] = 'Login berhasil.';
		$data['data'] = $response;

	} 
	else 
	{
		$data['result'] = 'false';
		$data['msg'] = 'Username atau password salah.';
	} 

	echo json_encode($data);
}


//if(isset($_POST['password'])){
//	$password  = $_POST['password'];
//}

//$password  = md5($_POST['password']);



 ?>