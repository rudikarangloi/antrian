
<?php
	if(isset($_POST['btn_save']))
	{
	    $txt_id      = $_POST['hidden_id'];
	    $txt_nomor   = $_POST['txt_nomor'];
	    $txt_nama    = $_POST['txt_nama'];
		$txt_kelamin = $_POST['txt_kelamin'];
									
	    $query = $mysqli->query("UPDATE loket_antrian SET client = '".$txt_nomor."',description = '".$txt_nama."',
									kode_layanan = '".$txt_kelamin."' where id = '".$txt_id."' ");

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
