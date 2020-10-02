<?php
		include "mysql_connect.php";
				
        $sql_loket = " ";
        $dLoket = $_POST['nomor_loket']; 
		$data = array();
		$data['peringatan'] = 0;
		$data['peringatan_absen'] = 0;
		$filter_jenis_antrian = " AND jenis_antrian_poliklinik = '0' ";		
			
    	if((isset($_POST['next_current']) || isset($_POST['next_repeat']) || isset($_POST['next_absen'])) && (($_POST['next_current'] != NULL) || ($_POST['next_repeat'] != NULL) || ($_POST['next_absen'] != NULL))){
    
			$id = intval($_POST['next_current'])+1;  		

			//------> Ambil id pertama dengan status=3
            $sql = "SELECT id as count, nomor, nomor_lama FROM data_antrian WHERE  STATUS = 3 ". $sql_loket . $filter_waktu . $filter_jenis_antrian . " ORDER BY id LIMIT 1";
            //echo $sql.'<p>';
			$rstClient = $mysqli->query($sql);			
    		$rowClient = $rstClient->fetch_array();
    		if($rowClient['count']){

				$id             = $rowClient['count'];
				$nomor_terkahir = $rowClient['nomor'];
				$nomor_lama     = $rowClient['nomor_lama'];					
				
				/*
				Cek field id apakah status sedang dipanggil [status=1]
				*/	
				//------> Ambil id tertinggi dengan status = 0 atau status = 1. Tidak akan pernah terjadi jika data tidak nyangkut
                $sqla = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket .$filter_waktu . $filter_jenis_antrian ." ORDER BY id LIMIT 1";
				//echo $sqla.'<p>';
              	$rsta = $mysqli->query($sqla);			
				$rows = $rsta->fetch_array();
				if($rows['count']){					
					$jmlCountId = $_POST['next_current'];
					$repeatId = $_POST['next_repeat'];
					
					if($repeatId != 0){						
						$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=1 AND nomor=$repeatId " . $filter_waktu . $filter_jenis_antrian ;						
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
						$rstCountId = $mysqli->query("SELECT MAX(nomor) as count FROM data_antrian WHERE STATUS = 2 ". $sql_loket. $filter_waktu . $filter_jenis_antrian." ORDER BY id ");
					}else{
						//Jika nomor antrian Tidak per loket
						//------> Ambil nomor terendah
						$rstCountId = $mysqli->query("SELECT MIN(nomor) as count FROM data_antrian WHERE STATUS = 3 ". $sql_loket . $filter_waktu . $filter_jenis_antrian ." ORDER BY id ");
                    }
                    
                    $rowCountId = $rstCountId->fetch_array();
                    
					if($rowCountId['count']>0){
						$jmlCountId = (int)$rowCountId['count'] ;
					}else{						
						$jmlCountId = 1;						
					}
										
					if($model_antrian == 1){
						//Jika nomor antrian per loket
						
						if($repeatId != 0){
							//Ulangi panggilan
							$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId AND loket = $dLoket " . $filter_waktu . $filter_jenis_antrian;
							$results = $mysqli->query($sqlb);
							$jmlCountId = $repeatId;
							
						}elseif(isset($_POST['next_absen'])){	
							
							if($nomor_terkahir != "1"){
								$absenId =	$_POST['next_absen'];						
							
								functionNotAbsent($absenId,$nomor_terkahir,$dLoket,$filter_waktu,$filter_jenis_antrian);							
							
								$jmlCountId = $nomor_terkahir;   //intval($_POST['next_current'])+1;
							}
				
							
							
						}else{
							$results = $mysqli->query('UPDATE data_antrian SET status=0,nomor = '.$jmlCountId.',loket = '.$dLoket.' WHERE id='.$id.'');
							//$results = $mysqli->query('UPDATE data_antrian SET status=0,nomor = '.$jmlCountId.',loket = '.$dLoket.' WHERE id ' . $filter_waktu . $filter_jenis_antrian );
						}
						
					}else{
						//Jika nomor antrian Tidak per loket
						
						if($repeatId != 0){
							//Ulangi panggilan
							//Cek apakah ada status 0 atau 1
							$sqlb = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket . $filter_waktu . $filter_jenis_antrian. " ORDER BY id LIMIT 1";							
							$rstb = $mysqli->query($sqlb);			
							$rows_cek = $rstb->fetch_array();
							if($rows_cek['count']){
								$data['peringatan'] = 1;
							}else{
								$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId ". $filter_waktu . $filter_jenis_antrian;
								$results = $mysqli->query($sqlb);
								$jmlCountId = $repeatId;
							}	

						}elseif(isset($_POST['next_absen'])){	

							if($nomor_terkahir != "1"){
								$absenId =	$_POST['next_absen'];						
							
								functionNotAbsent($absenId,$nomor_terkahir,$dLoket,$filter_waktu,$filter_jenis_antrian);							
							
								$jmlCountId = $nomor_terkahir; //intval($_POST['next_current'])+1;
							}
							
							
							
						}else{
							$results = $mysqli->query('UPDATE data_antrian SET status=0,loket = '.$dLoket.' WHERE id='.$id.'');
							//$results = $mysqli->query('UPDATE data_antrian SET status=0,loket = '.$dLoket.' WHERE id ' . $filter_waktu . $filter_jenis_antrian);
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
						$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId AND loket = $dLoket ". $filter_waktu . $filter_jenis_antrian;
					}else{
						
						//Cek apakah ada status 0 atau 1
						$sqlb = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket . $filter_waktu . $filter_jenis_antrian. " ORDER BY id LIMIT 1";							
						$rstb = $mysqli->query($sqlb);			
						$rows_cek = $rstb->fetch_array();
						if($rows_cek['count']){
							$data['peringatan'] = 1;
						}else{
							$sqlb = "UPDATE data_antrian SET STATUS=0 WHERE STATUS=2 AND nomor=$repeatId ". $filter_waktu . $filter_jenis_antrian;
						}
					}
					
					$results = $mysqli->query($sqlb);
					$jmlCountId = $repeatId;	
							
				}elseif(isset($_POST['next_absen'])){	
				
					//$absenId =	$_POST['next_absen'];						
							
					//functionNotAbsent($absenId,$dLoket,$filter_waktu,$filter_jenis_antrian);							
							
					//$jmlCountId = intval($_POST['next_current'])+1;
					
				}else{
								
					$rstCountId = $mysqli->query("SELECT MAX(nomor) as count FROM data_antrian WHERE STATUS = 2 ". $sql_loket . $filter_waktu . $filter_jenis_antrian ." ORDER BY id ");				
					$rowCountId = $rstCountId->fetch_array();
						
					if($rowCountId['count']>0){
						$jmlCountId = (int)$rowCountId['count'] ;
					}else{						
						$jmlCountId = 1;						
					}
				}
					
				
			}
		    //echo json_encode( array('next'=> $jmlCountId) );
			if($nomor_lama != ""){
				$data['peringatan_absen'] = $nomor_lama;
			}
						
			$data['next']    = $jmlCountId;	
			
			echo json_encode($data);
    	}else{
		
			$rstClient = $mysqli->query('SELECT count(*) as count, nomor, nomor_lama FROM data_antrian WHERE status!=3 ' . $sql_loket . $filter_waktu . $filter_jenis_antrian);
			$rowClient = $rstClient->fetch_array();
			if($rowClient['count']>0){
				$jmlClient = $rowClient['count'];
				$nomor_lama = $rowClient['nomor_lama'];
			}else{
				$jmlClient = 0;
				$nomor_lama = 0;
			}
		    //echo json_encode( array('next'=> $jmlClient) );
			
			if($nomor_lama != ""){
				$data['peringatan_absen'] = $nomor_lama;
			}
			
			$data['next'] = $jmlClient;	
			echo json_encode($data);
		}
    	include 'mysql_close.php';
		
		
		function functionNotAbsent($nomor_antrian,$nomor_antrian_next,$dLoket,$filter_waktu,$filter_jenis_antrian) {
			
			include "mysql_connect.php";
				
			$sql_loket = " ";
			//$dLoket = $_POST['nomor_loket']; 
			$data = array();
			$data['peringatan'] = 0;
			$filter_jenis_antrian = " AND jenis_antrian_poliklinik = '0' ";	
		
			/*
			//Cek apakah ada status 0 atau 1
			$sqlb = "SELECT id as count FROM data_antrian WHERE  (status = 0 OR status = 1) ". $sql_loket . $filter_waktu . $filter_jenis_antrian. " ORDER BY id LIMIT 1";							
			$rstb = $mysqli->query($sqlb);			
			$rows_cek = $rstb->fetch_array();
			if($rows_cek['count']){
				$data['peringatan'] = 1;
			}else{
			*/
				$absenId     = $nomor_antrian;	
				$absenIdNext = (int)$nomor_antrian_next;  //(int)$nomor_antrian + 1;
				$rstMaxCountId = $mysqli->query("SELECT MAX(nomor) as count FROM data_antrian WHERE STATUS ". $sql_loket. $filter_waktu . $filter_jenis_antrian." ORDER BY id ");
				$rowMaxCountId = $rstMaxCountId->fetch_array();
								
				if($rowMaxCountId['count']>0){
					$maxCountId = (int)$rowMaxCountId['count'] + 1;
				}else{						
					$maxCountId = 1;						
				}						
				//Ganti Status absen
				//$sqlb = "UPDATE data_antrian SET status_absen=0,nomor=$maxCountId,status=3 WHERE nomor=$absenId AND loket = $dLoket " . $filter_waktu . $filter_jenis_antrian;
				$sqlb = "UPDATE data_antrian SET status_absen=0 WHERE nomor=$absenId AND loket = $dLoket " . $filter_waktu . $filter_jenis_antrian;
				$results = $mysqli->query($sqlb);
				
				//$sqlb = "UPDATE data_antrian SET status=0 WHERE nomor=$absenIdNext AND loket = $dLoket " . $filter_waktu . $filter_jenis_antrian;
				$sqlb = "UPDATE data_antrian SET status=0,loket = $dLoket WHERE nomor=$absenIdNext " . $filter_waktu . $filter_jenis_antrian;
			
				$results = $mysqli->query($sqlb);
							
				$sqlb = "INSERT INTO data_antrian (  
								counter,waktu,STATUS,loket,nomor,fs_kd_layanan,status_error,input_from,nomorkartubpjs,nik, nomortelp, nomorreferensi,
								jenisreferensi,jenisantrian,jenispoli,kodebooking,waktudilayani,terlayani,namadokter,
								jenis_antrian_poliklinik,status_absen,nomor_lama
						)
						SELECT counter,waktu,3,loket,$maxCountId,fs_kd_layanan,status_error,input_from,nomorkartubpjs, nik,nomortelp,nomorreferensi,
								jenisreferensi,jenisantrian,jenispoli,kodebooking,waktudilayani,terlayani,namadokter,
								jenis_antrian_poliklinik,2,$absenId
						FROM data_antrian WHERE nomor=$absenId AND loket = $dLoket " . $filter_waktu . $filter_jenis_antrian;
							
				$results = $mysqli->query($sqlb);
			
		}	
    