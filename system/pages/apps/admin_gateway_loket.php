<?php
		/*
		require "../../php/connfile.php";
		require "../../php/functionfile.php";
		require "../../php/insertupdate.php";
		*/
    	include "mysql_connect.php";
		
		
		/*SQL SERVER*/
		/*
		if(isset($_POST['next_current']) and ($_POST['next_current'] != NULL)){
			$id = intval($_POST['next_current'])+1;
			
			$SQL=" SELECT count(*) as count FROM data_antrian WHERE id=".$id." ";
			$mRs = mssql_query($SQL);
			$mRo = mssql_fetch_array($mRs);
			$tRo = mssql_num_rows($mRs);
			if ($tRo>0){			
					//$id = $mRo[0];
					$SQL ="UPDATE data_antrian SET status=0 WHERE id=".$id."";
					$Rs = mssql_query($SQL);					
			}else{
					$waktu = date("Y-m-d H:i:s");
					$status = "3";
					
					$gTBL = "data_antrian";
					$gFLD = "";
					$gVAL = "";
					$gFLD = "waktu";
					$gVAL = "'$waktu'";				
					$gFLD.= ", status";
					$gVAL.= ", $status";

					InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
			}
			
			//-->echo json_encode( array('next'=> $id) );			
			
		}else{
			
			$SQL=" SELECT count(*) as count FROM data_antrian WHERE status!=3 ";
			$mRs = mssql_query($SQL);
			$mRo = mssql_fetch_array($mRs);
			$tRo = mssql_num_rows($mRs);
			if ($tRo>0){
				$count = $mRo[0];
				$jmlClient = $count;
			}else{
				$jmlClient = 0;
			}
			//-->echo json_encode( array('next'=> $jmlClient) );
		}
		
		mssql_close($ConSA);
		*/
	
	
		/*MYSQL SERVER*/
		//$loket = $_POST['nomor_loket'];      //$_SESSION["nomor_loket"];
		
		//$sql_loket = " AND counter = ".$loket ;
        $sql_loket = " ";
        $dLoket = $_POST['nomor_loket']; 
		$data = array();
		$data['peringatan'] = 0;
	
			
    	if((isset($_POST['next_current']) || isset($_POST['next_repeat'])) && (($_POST['next_current'] != NULL) || ($_POST['next_repeat'] != NULL))){
    		$id = intval($_POST['next_current'])+1;  		

			//------> Ambil id pertama dengan status=3
            $sql = "SELECT id as count FROM data_antrian WHERE  STATUS = 3 ". $sql_loket .$filter_waktu. " ORDER BY id LIMIT 1";
            //echo $sql.'<p>';
			$rstClient = $mysqli->query($sql);			
    		$rowClient = $rstClient->fetch_array();
    		if($rowClient['count']){

				$id = $rowClient['count'];	
				
				/*
				Cek field id apakah status sedang dipanggil [status=1]
				*/	
				//------> Ambil id tertinggi dengan status = 0 atau status = 1. Tidak akan pernah terjadi jika data tidak nyangkut
                $sqla = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket .$filter_waktu." ORDER BY id LIMIT 1";
				//echo $sqla.'<p>';
              	$rsta = $mysqli->query($sqla);			
				$rows = $rsta->fetch_array();
				if($rows['count']){					
					$jmlCountId = $_POST['next_current'];
					$repeatId = $_POST['next_repeat'];
					
					if($repeatId != 0){						
						$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=1 AND nomor=$repeatId;";						
						$results = $mysqli->query($sqlb);
						$data['peringatan'] = 1;						
					}else{				
						$data['peringatan'] = 1;
					}
					
				}else{					
					$repeatId = $_POST['next_repeat'];
					
					/*Ambil nomor tertinggi*/					
					
					if($model_antrian == 1){
						//Jika nomor antrian per loket
						$rstCountId = $mysqli->query("SELECT MAX(nomor) as count FROM data_antrian WHERE STATUS = 2 ". $sql_loket.$filter_waktu." ORDER BY id ");
					}else{
						//Jika nomor antrian Tidak per loket
						//------> Ambil nomor terendah
						$rstCountId = $mysqli->query("SELECT MIN(nomor) as count FROM data_antrian WHERE STATUS = 3 ". $sql_loket.$filter_waktu." ORDER BY id ");
                    }
                    
                    $rowCountId = $rstCountId->fetch_array();
                    
					if($rowCountId['count']>0){
						$jmlCountId = (int)$rowCountId['count'] ;
					}else{						
						$jmlCountId = 1;						
					}
					/*---------------------*/			
					
					if($model_antrian == 1){
						//Jika nomor antrian per loket
						
						if($repeatId != 0){
							//Ulangi panggilan
							$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId AND loket = $dLoket ";
							$results = $mysqli->query($sqlb);
							$jmlCountId = $repeatId;
						}else{
							$results = $mysqli->query('UPDATE data_antrian SET status=0,nomor = '.$jmlCountId.',loket = '.$dLoket.' WHERE id='.$id.'');
						}
						
					}else{
						//Jika nomor antrian Tidak per loket
						
						if($repeatId != 0){
							//Ulangi panggilan
							//Cek apakah ada status 0 atau 1
							$sqlb = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket .$filter_waktu." ORDER BY id LIMIT 1";							
							$rstb = $mysqli->query($sqlb);			
							$rows_cek = $rstb->fetch_array();
							if($rows_cek['count']){
								$data['peringatan'] = 1;
							}else{
								$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId;";
								$results = $mysqli->query($sqlb);
								$jmlCountId = $repeatId;
							}								
							
						}else{
							$results = $mysqli->query('UPDATE data_antrian SET status=0,loket = '.$dLoket.' WHERE id='.$id.'');
						}
					}			
					
				}		
				
			
				//update
			}else{
				//Not insert
				//Jika telah diakhir antrian, panggil nomor tertinggi yg memiliki status 2/telah dipanggil
				//$results = $mysqli->query('INSERT INTO data_antrian (waktu,status) VALUES ("'.date("Y-m-d H:i:s").'",3)');
				
				$repeatId = $_POST['next_repeat'];
									
				if($repeatId != 0){
					
					//Ulangi panggilan Jika diakhir antrian (Status = 2 semuanya)	
					if($model_antrian == 1){
						$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId AND loket = $dLoket ";
					}else{
						
						//Cek apakah ada status 0 atau 1
						$sqlb = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket .$filter_waktu." ORDER BY id LIMIT 1";							
						$rstb = $mysqli->query($sqlb);			
						$rows_cek = $rstb->fetch_array();
						if($rows_cek['count']){
							$data['peringatan'] = 1;
						}else{
							$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId;";
						}
					}
					
					$results = $mysqli->query($sqlb);
					$jmlCountId = $repeatId;					
					
				}else{
				
					$rstCountId = $mysqli->query("SELECT MAX(nomor) as count FROM data_antrian WHERE STATUS = 2 ". $sql_loket.$filter_waktu." ORDER BY id ");				
					$rowCountId = $rstCountId->fetch_array();
						
					if($rowCountId['count']>0){
						$jmlCountId = (int)$rowCountId['count'] ;
					}else{						
						$jmlCountId = 1;						
					}
				}
					
				
			}
		    //echo json_encode( array('next'=> $jmlCountId) );
			
			$data['next']    = $jmlCountId;	
			
			echo json_encode($data);
    	}else{
		
			$rstClient = $mysqli->query('SELECT count(*) as count FROM data_antrian WHERE status!=3 ' . $sql_loket.$filter_waktu);
			$rowClient = $rstClient->fetch_array();
			if($rowClient['count']>0){
				$jmlClient = $rowClient['count'];
			}else{
				$jmlClient = 0;
			}
		    //echo json_encode( array('next'=> $jmlClient) );
			
			$data['next'] = $jmlClient;	
			echo json_encode($data);
		}
    	include 'mysql_close.php';
    