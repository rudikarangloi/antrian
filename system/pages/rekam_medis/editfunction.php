
<?php
	if(isset($_POST['btn_save']))
	{
		
	    $txt_id      = $_POST['hidden_id'];
		/*
	    $txt_nomor   = $_POST['txt_nomor'];
	    $txt_nama    = $_POST['txt_nama'];
	    $txt_kelamin = $_POST['txt_kelamin'];
		$kdpoli      = $_POST['kdpoli'];
		$kuota_hp    = $_POST['kuota_hp'];
		*/
		
		$status_rm    = $_POST['status_rm'];
		$status_poli  = $_POST['status_poli'];

										
	    //$query = $mysqli->query("UPDATE client_antrian SET client = '".$txt_nomor."',description = '".$txt_nama."',
		//							kode_layanan = '".$txt_kelamin."',kdpoli = '".$kdpoli."',kuota_hp = '".$kuota_hp."' where id = '".$txt_id."' ");
		
		$query = $mysqli->query("UPDATE data_antrian_detail SET aproove_rm = '".$status_rm."',approve_poli = '".$status_poli."' WHERE id = '".$txt_id."' ");
		
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
