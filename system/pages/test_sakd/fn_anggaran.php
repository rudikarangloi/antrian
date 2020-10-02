<?php 	
require_once 'mysql_connect.php'; 

if($SK=="." || $SK == "" || $SK = "00.00" || $SK == "-"){
	$SK="%";
	$strSk = "x.xx.xx";
}else{
	if($_POST['Perd'] == "1" || $_POST['Penj'] == "1"){
		$SK = $SK;
	}else{
		 if($SKU == "0.00" || $SKU == "00.00"){
			 $SKU = "%";
		 }
		$SK = $SKU. "." .$SK;
	}
	
	$strSk = $SK ;
	
}	

$Sql_SK = " AND (ID_Kegiatan Like '"&SK&"%' OR ISNULL(ID_Kegiatan))" ; 

if($_POST['DRSK'] == "SKPD 2.2.1" ){
	if($IDK != ""){
        $Sql_SK = " AND (ID_Kegiatan Like '"& IDK &"%' OR ISNULL(ID_Kegiatan))";
    }else{
        $Sql_SK = " AND (ID_Kegiatan = '-' OR ISNULL(ID_Kegiatan))";
    }
}

if($_POST['DRSK'] == "SKPD 2.2.1" ){
	if($IDK != ""){
        $Sql_SK = $Sql_SK . " AND Sub_Kegiatan LIKE '".$_POST["Sub_Kegiatan"]."' ";
    }else{
        $Sql_SK = $Sql_SK . " AND Sub_Kegiatan LIKE '".$_POST["Sub_Kegiatan"]."' ";
    }
}

   
if($_POST['pisah_sumber_dana'] == "1" ){
	if($IDK != ""){
        $Sql_SK = $Sql_SK . " AND Sumber_Dana = '".$_POST["Sumber_Dana"]."' " ;
    }else{
        $Sql_SK = $Sql_SK . " AND Sumber_Dana = '".$_POST["Sumber_Dana"]."' " ;
    }
}

$Sql_SK_Pemb = " AND (Referensi Like '%".$SK."%' OR ISNULL(Referensi))"  ;
$sql_per = " AND periode='".$T."' AND Perubahan='".$U."' ";
$TipeModul_Pend = 0;
$TipeModul_BLangsung = 0;
$TipeModul_BTLangsung  = 0 ;       
$TipeModul_Pemb_Penerimaan = 0;
$TipeModul_Pemb_Pengeluaran = 0;

Kriteria = Request("DRSK")
	Select Case Kriteria
	Case "SKPD 1"
		TipeModul_Pend = 1
	Case "SKPD 2"
		TipeModul_BTLangsung = 1 
		TipeModul_BLangsung  = 1
	Case "SKPD 2.1"
		TipeModul_BTLangsung = 1
	Case "SKPD 2.2.1"
		TipeModul_BLangsung  = 1
	Case "SKPD 3.1"
		TipeModul_Pemb_Penerimaan = 1 
	Case "SKPD 3.2"
		TipeModul_Pemb_Pengeluaran = 1 
	Case else
		TipeModul_Pend = 1
		TipeModul_BLangsung = 1
		TipeModul_BTLangsung  = 1        
		TipeModul_Pemb_Penerimaan = 1
		TipeModul_Pemb_Pengeluaran = 1         
	end select
	
$Kriteria = $_POST["DRSK"];
switch ($Kriteria) {
    case "SKPD 1":
        $TipeModul_Pend = 1;
        break;
    case "SKPD 2":
        $TipeModul_BTLangsung = 1 ;
		$TipeModul_BLangsung  = 1 ;
        break;
    case "SKPD 2.1":
        $TipeModul_BTLangsung = 1;
        break;
	case "SKPD 2.2.1":
        $TipeModul_BLangsung  = 1 ;
        break;
	case "SKPD 3.1":
        $TipeModul_Pemb_Penerimaan = 1 ;
        break;
	case "SKPD 3.2":
        $TipeModul_Pemb_Pengeluaran = 1 ;
        break;
	
    default:
        $TipeModul_Pend = 1;
		$TipeModul_BLangsung = 1;
		$TipeModul_BTLangsung  = 1;        
		$TipeModul_Pemb_Penerimaan = 1;
		$TipeModul_Pemb_Pengeluaran = 1  ;
}


function describeData($Arg_NRK) {
	
	$Model = $_POST["Level"]; 
	
	switch ($Model) {
		case "Kelompok":
			$Ambil_NoRek = 3;
			$Tanda = "I" ;
			break;
		case "Jenis":
			$Ambil_NoRek = 6;
		    $Ambil_Kelompok = 3;
		    $Tanda = "II";
			break;
		case "Objek":
			$Ambil_NoRek = 9;
		    $Ambil_Kelompok = 3;
		    $Ambil_Objek = 6;
		    $Tanda = "III";
			break;
		case "Rincian_Objek":
			$Ambil_NoRek = 12;
		    $Tanda = "IV" ;
		    $Ambil_Kelompok = 3;
		    $Ambil_Objek = 6;
		    $Ambil_Rincian_Objek = 9  ;				
		
	}
	
	
	if(substr($Arg_NRK,0) == "4"){
		$strsql = " SELECT b.no_rekening,b.nama_coa,sum(jumlah) as jml,ID_Kegiatan from anggaran_Kegiatan a Right join coa_Kota b ON a.no_rekening = b.no_rekening where b.no_rekening like '". $Arg_NRK  ."'  ". $Sql_SK . $sql_per ." group by left(b.no_rekening,". $Ambil_NoRek .") Order by b.No_Rekening" ;
	}else{
		$strsql = " SELECT b.no_rekening,b.nama_coa,sum(jumlah) as jml,ID_Kegiatan from anggaran_Kegiatan a Right join coa_Kota b ON a.no_rekening = b.no_rekening where b.no_rekening like '". $Arg_NRK  ."'  ". $Sql_SK . $sql_per ." group by left(b.no_rekening,". $Ambil_NoRek .") Order by Length(b.No_rekening),b.No_Rekening"
	}
	
	$sqla         = "select sum(jumlah) as jml from anggaran_Kegiatan where no_rekening like '". $Arg_NRK ."' ". $Sql_SK . $sql_per ." group by left(no_rekening,". $Ambil_Kelompok .")";
	$sql_Obj      = "select sum(jumlah) as jml from anggaran_Kegiatan where no_rekening like '". $Arg_NRK ."' ".$Sql_SK . $sql_per." group by left(no_rekening,". $Ambil_Objek .")" ;
	$sql_Rinc_Obj = "select sum(jumlah) as jml from anggaran_Kegiatan where no_rekening like '". $Arg_NRK ."' ".$Sql_SK . $sql_per." group by left(no_rekening,". $Ambil_Rincian_Objek .")" ;
   
	$NRK_JNS = "0" ;   
	$NRK_JNS2 = ".00.00";
	$NRK_JNS3 = ".00";
	
	/*
	set rst = con.execute(strsql)    
	if not rst.eof then

	*/
	
	$result = mysqli_query($conn, $strsql);
    //$response = array();
    while( $row = mysqli_fetch_assoc($result) ){
        /*
		array_push($response, 
        array(
                'id_program'=>$row['id_program'], 
				'description'=>$row['nama_program']
             ) 
        );
		*/
		$r = 1 ;
		$Bagian  = "";
		$Str_Bagian = "";
		$CompI   = "";
		$CompII  = "";
		$CompIII = "";
		$CompIV  = "";

		
		
    }




	
	//return $deliveryPrice;   
}

  
  