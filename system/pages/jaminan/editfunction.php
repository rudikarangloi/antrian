
<?php
	if(isset($_POST['btn_save']))
	{
	    $txt_id      = $_POST['hidden_id'];
	    $txt_nomor   = $_POST['txt_nomor'];
	    $txt_nama    = $_POST['txt_nama'];

		$edit_txt_nama = str_replace(" ","===",$txt_nama,$count);
				
		$api_url = 'http://localhost:8090/sql_server_develop/update_ta_jaminan.php?input_data='.$edit_txt_nama.'&kode='.$txt_id;
		//$api_url = 'http://localhost:8090/sql_server_develop/update_ta_jaminan.php?input_data=SOSIALLITAsss&kode=003';

		$json_data = file_get_contents($api_url);

		
	    if($query == true){
	        $_SESSION['edit'] = 1;
	        header("location: ".$_SERVER['REQUEST_URI']);
	    }

		if(mysqli_error($con)){
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
		
		$delay = 0; // Where 0 is an example of a time delay. You can use 5 for 5 seconds, for example!
		header("Refresh: $delay;"); 
		
	}
?>
