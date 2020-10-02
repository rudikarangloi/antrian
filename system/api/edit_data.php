<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$individu_id  = $_POST['individu_id'];
	$no_induk  = $_POST['no_induk'];
	$full_name = $_POST['full_name'];
	$hp        = $_POST['hp'];
	$side_job  = $_POST['side_job'];

	require_once 'connect.php';
	
	$sql = "UPDATE as_individu SET no_induk='$no_induk',full_name='$full_name',hp= '$hp',side_job = '$side_job' WHERE individu_id = $individu_id";
	
	if(mysqli_query($conn,$sql)){
		echo "Berhasil Update Data";
	}else{
		echo "Gagal Update Data";	
	}
}


?>