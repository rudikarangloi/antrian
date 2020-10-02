
<?php
	if(isset($_POST['btn_save']))
	{
	    $txt_id      = $_POST['hidden_id'];
	    $txt_nomor   = $_POST['txt_nomor'];
	    $txt_nama    = $_POST['txt_nama'];
	    $txt_kelamin = $_POST['txt_kelamin'];
		$kdpoli      = $_POST['kdpoli'];
		$kuota_hp    = $_POST['kuota_hp'];		
		$mystatus    = $_POST["mystatus1"];			
		$status      = $_POST["status"];
		$dokter      = $_POST["dokter"];
		
		//echo 	$kuota_hp." -- ". $mystatus." -- ".$selected_radio ."----".$numbers;
		
	    $query = $mysqli->query("UPDATE client_antrian SET client = '".$txt_nomor."',description = '".$txt_nama."',
									kode_layanan = '".$txt_kelamin."',kdpoli = '".$kdpoli."',kuota_hp = '".$kuota_hp."',
									dokter = '".$dokter."',status = '".$status."' 
									WHERE id = '".$txt_id."' ");
		
       $sql = "UPDATE client_antrian SET client = '".$txt_nomor."',description = '".$txt_nama."',
									kode_layanan = '".$txt_kelamin."',kdpoli = '".$kdpoli."',kuota_hp = '".$kuota_hp."',
									dokter = '".$dokter."',status = '".$status."' 
									WHERE id = '".$txt_id."' ";
			
	    if($query == true){
	        $_SESSION['edit'] = 1;
	        header("location: ".$_SERVER['REQUEST_URI']);
	    }

		if(mysqli_error($con)){
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
		
		
	}
?>
