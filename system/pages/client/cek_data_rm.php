<?php
//require "connfile-php7.php";
require "functionfile-php7.php";
include "../apps/mysql_connect.php";

extract($_POST);
extract($_GET);

if(isset($_POST['input_data'])){

		/*
        $query    = " SELECT FS_NM_PASIEN AS FldD FROM tc_mr WHERE FS_MR = '". $input_data ."' ";
        $sql      = sqlsrv_query($ConSA, $query, array(), array('Scrollable' => 'static'));
        $ketemu   = sqlsrv_num_rows($sql);
        $data     = sqlsrv_fetch_array($sql);
		
		if ($ketemu > 0) {
            $json['peringatan'] = 0;
            // $_SESSION['FldD'] = $data['FldD'];            
        }else{
            $json['peringatan'] = 1;
        }
		
		*/
		$sql = "SELECT FS_NM_PASIEN AS FldD FROM tc_mr WHERE FS_MR = '". $input_data ."'";
		//echo $sql;
		$rstClient = $mysqli->query($sql);			
    	$rowClient = $rstClient->fetch_array();
    	if($rowClient['FldD']){
			$json['peringatan'] = 0;
		}else{
			$json['peringatan'] = 1;
		}       
}

echo json_encode($json);
?>