<?php

	$individu_id    = $_POST['individu_id'];
	
	require_once 'connect.php';
	
	$sql = "DELETE FROM as_individu WHERE individu_id = $individu_id";
	
	if(mysqli_query($conn,$sql)){
		echo "Berhasil Hapus Data";
	}else{
		echo "Gagal Hapus Data";	
	}


?>