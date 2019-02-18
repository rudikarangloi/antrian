<?php

//require "connfile-php7.php";
require "functionfile-php7.php";
require "insertupdate-php7.php";

include "../apps/mysql_connect.php";

extract($_POST);
extract($_GET);




// echo "input_data : ". $input_data;
// echo "<br>radCaraBayar : ". $radCaraBayar;
// echo "<br>idPerusahaan : ". $idPerusahaan;
// echo "<br>nmPerusahaan : ". $nmPerusahaan;
// echo "<br>fBpJK : ". $fBpJK;
// echo "<br>fKtEP : ". $fKtEP;
// echo "<br>fNmaB : ". $fNmaB;
// echo "<br>fJnpK : ". $fJnpK;
// echo "<br>fJnpD : ". $fJnpD;
// echo "<br>fJnpD : ". $fJnpD;
// echo "<br>fKelK : ". $fKelK;
// echo "<br>fKelD : ". $fKelD;
// echo "<br>fStaK : ". $fStaK;
// echo "<br>fStaD  : ". $fStaD;
// echo "<br>fLakA  : ". $fLakA;
// echo "<br>fLokA  : ". $fLokA;

// exit;

$Jns = 0;
$fNoRM = unParseRM($fNoRM);

if ($fLakA=="2"){$fLokA="";}
$AskPrint="N";

if($fSave="SAVE"){

//Tarif Registrasi
$nTrFK = 0;
$tNmP  = fGlobal("fs_nm_pasien","tc_mr","fs_mr",$fNoRM,"=","",DatabaseSA,$ConSA,"");

//Bayar Tunai
$fTuNK = 0;
$fSiSK = $nTrFK-$fTuNK;

$RekSIS= "1031.0101";
$RekBYR= "1011.011";

//Tanggal Masuk
$fTgLM = date("Y-n-j");
$fJaMM = date("H:i:s");
$gUsER = "MANDIRI";

//Jenis inap
$fInPK = "";
//Kelas perawatan
$fKlSK = "";
//Tarif Registrasi
$fTrFK = "";
//Rujukan dari
$fRjKK = "";
//No.reg ibu 
$fIbUK = "";
//Anamnesa
$fAnAM="";
//SMF/UPF
$fSmFK="";


$KnJK = fGlobal("isnull(max(fn_kunjunganke),0)","ta_registrasi","fs_mr",$fNoRM,"=","",DatabaseSA,$ConSA,"");
//$KnJK = fGlobal("COUNT(fn_kunjunganke)","ta_registrasi","fs_mr",$fNoRM,"=","",DatabaseSA,$ConSA,"1");
$KnJK++;

$fMsKK = 8;

//pembayaran Umum
if($radCaraBayar=='V3'){
    $fJmNK = $idPerusahaan;
}elseif ($radCaraBayar=='001') {
    $fJmNK = $radCaraBayar;
}else{
    $fJmNK = 'BPJ';
}


$fLaYK = strtoupper($fLaYK);


$AskPrint="Y";
$PrmA = fGlobal("fn_registrasi_masuk","t_parameter","fn_registrasi_masuk","%","LIKE","",DatabaseSA,$ConSA,"");
$PrmB = $PrmA+1;
$tNEW = substr(str_repeat('0',10).$PrmA,-10,10);
$tREG = $tNEW;
		
// $SQ ="UPDATE t_parameter SET fn_registrasi_masuk=".$PrmB;
// $Rs = mssql_query($SQ);

$SQ ="UPDATE t_parameter SET fn_registrasi_masuk=".$PrmB;
$Rs = sqlsrv_query($ConSA, $SQ);

//Insert Tabel ta_registrasi
$gTBL = "ta_registrasi";
$gFLD = "";
$gVAL = "";
$gFLD = "fs_kd_reg";
$gVAL = "'$tREG'";
$gFLD.= ", fs_mr";
$gVAL.= ", '".$fNoRM."'";
$gFLD.= ", fd_tgl_masuk";
$gVAL.= ", '".$fTgLM."'";
$gFLD.= ", fs_jam_masuk";
$gVAL.= ", '".$fJaMM."'";
$gFLD.= ", fs_kd_petugas";
$gVAL.= ", '".$gUsER."'";

$gFLD.= ", fs_kd_layanan";
$gVAL.= ", '".$fLaYK."'";

$gFLD.= ", fs_kd_layanan_akhir";
$gVAL.= ", '".$fLaYK."'";

$gFLD.= ", fs_kd_jenis_inap";
$gVAL.= ", '".$fInPK."'";

$gFLD.= ", fs_kd_kelas";
$gVAL.= ", '".$fKlSK."'";

$gFLD.= ", fn_kunjunganke";
$gVAL.= ", ".$KnJK;

$gFLD.= ", fs_kd_cara_masuk_dk";
$gVAL.= ", '".$fMsKK."'";

###################
$gFLD.= ", fs_kd_karcis";
$gVAL.= ", '".$fTrFK."'";

$gFLD.= ", fn_karcis";
$gVAL.= ", ".$nTrFK;

$gFLD.= ", fn_karcis_bayar";
$gVAL.= ", ".$fTuNK;

$gFLD.= ", fn_karcis_sisa";
$gVAL.= ", ".$fSiSK;
###################


$gFLD.= ", fs_kd_rujukan";
$gVAL.= ", '".$fRjKK."'";

$gFLD.= ", fs_reg_ibu";
$gVAL.= ", '".$fIbUK."'";

$gFLD.= ", fs_kd_rek_sisa";
$gVAL.= ", '".$RekSIS."'";

$gFLD.= ", fs_kd_rek_bayar";
$gVAL.= ", '".$RekBYR."'";

$gFLD.= ", fs_nm_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_alm_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_alm2_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_kota_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_hub_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_id_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_kd_jaminan";
$gVAL.= ", '".$fJmNK."'";

$gFLD.= ", fb_dari_bawah";
$gVAL.= ", 0";

$gFLD.= ", fs_umur";
$gVAL.= ", '045-00-25'";

$gFLD.= ", fs_jam_keluar";
$gVAL.= ", '".$fJaMM."'";

$gFLD.= ", fs_kd_status_penjamin";
$gVAL.= ", ''";

$gFLD.= ", fs_ket_anamnesa";
$gVAL.= ", '".$fAnAM."'";

$gFLD.= ", fs_kd_smf";
$gVAL.= ", '".$fSmFK."'";

$gFLD.= ", fd_tgl_void";
$gVAL.= ", '3000-01-01'";

$gFLD.= ", fs_jam_void";
$gVAL.= ", ''";

$gFLD.= ", fd_tgl_keluar";
$gVAL.= ", '3000-01-01'";

$gFLD.= ", fs_jam_selesai_tdk";
$gVAL.= ", ''";

$gFLD.= ", fn_ld";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_KWITANSI";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_JAMINAN_SUBSIDI";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_JAMINAN_SISA";
$gVAL.= ", ''";

$gFLD.= ", FN_TOTAL";
$gVAL.= ", '".$nTrFK."'";

$gFLD.= ", FN_SUBSIDI";
$gVAL.= ", 0";

$gFLD.= ", FN_KLAIM";
$gVAL.= ", 0";

$gFLD.= ", FN_TUNAI";
$gVAL.= ", 0";

$gFLD.= ", FN_SISA";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_REK_SUBSIDI_YANKES";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_KLAIM_YANKES";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_TUNAI_YANKES";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_SISA_YANKES";
$gVAL.= ", ''";

$gFLD.= ", FN_TOTAL_OBAT";
$gVAL.= ", 0";

$gFLD.= ", FN_SUBSIDI_OBAT";
$gVAL.= ", 0";

$gFLD.= ", FN_KLAIM_OBAT";
$gVAL.= ", 0";

$gFLD.= ", FN_TUNAI_OBAT";
$gVAL.= ", 0";

$gFLD.= ", FN_SISA_OBAT";
$gVAL.= ", 0";

$gFLD.= ", FN_SISA_KLAIM";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_KASIR";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_SUBSIDI_OBAT";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_KLAIM_OBAT";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_TUNAI_OBAT";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_SISA_OBAT";
$gVAL.= ", ''";

$gFLD.= ", FS_KET";
$gVAL.= ", ''";

$gFLD.= ", FN_PIUTANG";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_PROSEDUR_MASUK";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_PETUGAS_VOID";
$gVAL.= ", ''";

$gFLD.= ", FN_KARTU_KE";
$gVAL.= ", 0";

$gFLD.= ", FD_TGL_KARTU";
$gVAL.= ", ''";

$gFLD.= ", FN_CETAK_LIST_KE";
$gVAL.= ", 1";

$gFLD.= ", FS_KD_JENIS_BAYAR";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_BIN";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_BANK";
$gVAL.= ", ''";

$gFLD.= ", FN_SUBSIDI_PIUTANG";
$gVAL.= ", 0";

$gFLD.= ", FN_KLAIM_PIUTANG";
$gVAL.= ", 0";

$gFLD.= ", FN_TUNAI_PIUTANG";
$gVAL.= ", 0";

$gFLD.= ", FN_SISA_PIUTANG";
$gVAL.= ", 0";

$gFLD.= ", FN_DEPOSIT_YANKES";
$gVAL.= ", 0";

$gFLD.= ", FN_DEPOSIT_OBAT";
$gVAL.= ", 0";

$gFLD.= ", FN_DEPOSIT_PIUTANG";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_REK_SUBSIDI_PIUTANG";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_KLAIM_PIUTANG";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_TUNAI_PIUTANG";
$gVAL.= ", ''";

$gFLD.= ", FS_KD_REK_SISA_PIUTANG";
$gVAL.= ", ''";

$gFLD.= ", FN_TINGGI_BADAN";
$gVAL.= ", 0";

$gFLD.= ", FN_BERAT_BADAN";
$gVAL.= ", 0";

$gFLD.= ", FS_JAM_TDK";
$gVAL.= ", ''";

$gFLD.= ", FN_STATUS_TDK";
$gVAL.= ", 0";

$gFLD.= ", FS_TIME_ISO";
$gVAL.= ", ''";

$gFLD.= ", FS_TIME_ISO2";
$gVAL.= ", ''";

$gFLD.= ", FN_LAMA_ISO_DETIK";
$gVAL.= ", 0";

$gFLD.= ", FS_TIME1_ISO";
$gVAL.= ", ''";

$gFLD.= ", FS_TIME1_ISO2";
$gVAL.= ", ''";

$gFLD.= ", FN_LAMA1_ISO_DETIK";
$gVAL.= ", 0";

$gFLD.= ", FN_SIMPAN_KALI";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_PETUGAS_CANCEL_OUT";
$gVAL.= ", ''";

$gFLD.= ", FD_TGL_CANCEL_OUT";
$gVAL.= ", ''";

$gFLD.= ", FS_JAM_CANCEL_OUT";
$gVAL.= ", ''";

$gFLD.= ", FN_CANCEL_OUT";
$gVAL.= ", 0";

$gFLD.= ", FS_KD_MEDIS";
$gVAL.= ", ''";

$gFLD.= ", ToBLUD";
$gVAL.= ", 0";

InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
	
if($radCaraBayar=="V2"){
        //BPJS
        //Diagnosa Awal	
        $fDiAK = "";
        //Nomor Rujukan	 
        $fRjNK = "";
        //No.PPK
        $fRjPK = "";
        //PPK Rujukan
        $fFskK = "";
        $fFskD = "";
        //Tanggal Rujukan
        $fTgLR = "";
        //Jam Rujukan
        $fJaMR = "";
        //Catatan Khusus
        $fCatA = "";

        $gTBL = "ta_registrasi_bpjs";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "fs_kd_reg";
		$gVAL = "'$tREG'";
		
		$gFLD.= ", fs_mr";
		$gVAL.= ", '".$fNoRM."'";
		
		$gFLD.= ", fd_tgl_masuk";
		$gVAL.= ", '".$fTgLM."'";
		
		$gFLD.= ", fs_jam_masuk";
		$gVAL.= ", '".$fJaMM."'";
		
		$gFLD.= ", FS_BPJS_NO_SEP";
		$gVAL.= ", ''";
		
		$gFLD.= ", FS_LAKALANTAS";
		$gVAL.= ", '".$fLakA."'";
		
		$gFLD.= ", FS_LAKALANTAS_LOKASI";
		$gVAL.= ", '".$fLokA."'";
		
		$gFLD.= ", FS_KD_DIAGNOSA";
		$gVAL.= ", '".$fDiAK."'";
		
		$gFLD.= ", FS_NORUJUK";
		$gVAL.= ", '".$fRjNK."'";
		
		$gFLD.= ", FS_NOPPKRUJUK";
		$gVAL.= ", '".$fRjPK."'";
		
		$gFLD.= ", FS_NOKARTUBPJS";
        $gVAL.= ", '".$fBpJK."'";
       		
		$gFLD.= ", FS_NOPPKRUJUK_AWAL";
		$gVAL.= ", '".$fFskK."'";
		
		$gFLD.= ", FS_NMPPKRUJUK_AWAL";
		$gVAL.= ", '".$fFskD."'";
		
		$gFLD.= ", FD_TGLRUJUK";
		$gVAL.= ", '".$fTgLR."'";
		
		$gFLD.= ", FD_JAMRUJUK";
		$gVAL.= ", '".$fJaMR."'";
		
		$gFLD.= ", FS_CATATAN_KHUSUS";
		$gVAL.= ", '".$fCatA."'";
		
        InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
}
        

        //ANTRIAN
		$rAnt = fGlobal("max(fn_no_antrian)","ta_antrian","fd_tgl_antrian:fs_kd_layanan",$fTgLM.":".$fLaYK,"=:=","",DatabaseSA,$ConSA,"");
		$rAnt = (int)$rAnt+1;
		
		$gTBL = "ta_antrian";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "FS_KD_ANTRIAN";
		$gVAL = "''";
		$gFLD.= ", FD_TGL_ANTRIAN";
		$gVAL.= ", '".$fTgLM."'";
		$gFLD.= ", FN_NO_ANTRIAN";
		$gVAL.= ", '".$rAnt."'";
		$gFLD.= ", FS_KD_LAYANAN";
		$gVAL.= ", '".$fLaYK."'";
		$gFLD.= ", FS_KD_DAFTAR";
		$gVAL.= ", '".$tREG."'";
		$gFLD.= ", FN_ANTRIAN";
		$gVAL.= ", 0";
		$gFLD.= ", FB_STATUS";
        $gVAL.= ", 0";
        
        InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);


        #ta_trs_billing
		$gTBL = "ta_trs_billing";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "FS_KD_TRS";
		$gVAL = "'REG".$tREG."'";
		$gFLD.= ", FN_JENIS_TRS";
		$gVAL.= ", '".$Jns."'";
		$gFLD.= ", FD_TGl_TRS";
		$gVAL.= ", '".$fTgLM."'";
		$gFLD.= ", FS_JAM_TRS";
		$gVAL.= ", '".$fJaMM."'";
		$gFLD.= ", FS_KD_PETUGAS";
		$gVAL.= ", '".$gUsER."'";
		$gFLD.= ", FS_KD_REG";
		$gVAL.= ", '".$tREG."'";
		$gFLD.= ", FS_KD_LAYANAN";
		$gVAL.= ", '".$fLaYK."'";
		$gFLD.= ", FS_KD_KELAS";
		$gVAL.= ", '".$fKlSK."'";
		$gFLD.= ", FN_SUB_TOTAL";
		$gVAL.= ", '".$nTrFK."'";
		$gFLD.= ", FN_DISKON";
		$gVAL.= ", 0";
		$gFLD.= ", FN_HARGA_DISKON";
		$gVAL.= ", '".$nTrFK."'";
		$gFLD.= ", FN_TAX";
		$gVAL.= ", 0";
		$gFLD.= ", FN_BIAYA";
		$gVAL.= ", 0";
		$gFLD.= ", FN_TOTAL";
		$gVAL.= ", '".$nTrFK."'";
		$gFLD.= ", FN_TUNAI";
		$gVAL.= ", '".$fTuNK."'";
		$gFLD.= ", FN_SISA";
		$gVAL.= ", '".$fSiSK."'";
		$gFLD.= ", FN_DIJAMIN";
		$gVAL.= ", 0";
		$gFLD.= ", FN_TOTAL_DIJAMIN";
		$gVAL.= ", 0";
		$gFLD.= ", FS_FILLER";
		$gVAL.= ", ''";
		$gFLD.= ", FS_KETERANGAN";
		$gVAL.= ", 'Biaya registrasi masuk.'";
		$gFLD.= ", FS_KETERANGAN2";
		$gVAL.= ", 'Non Operatif'";
		$gFLD.= ", FB_CETAK";
		$gVAL.= ", 'False'";
		
        InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
        

        #T_HdrTrans
		$gTBL = "t_hdrTrans";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "FS_NO_BUKTI";
		$gVAL = "'XREG".$tREG."'";
		$gFLD.= ", FD_TGL_TRANS";
		$gVAL.= ", '".$fTgLM."'";
		$gFLD.= ", FS_JAM_TRANS";
		$gVAL.= ", '".$fJaMM."'";
		$gFLD.= ", FS_KETERANGAN";
		$gVAL.= ", 'REG:".$tREG."/".$tNmP."'";
		$gFLD.= ", FS_KD_PETUGAS";
		$gVAL.= ", '".$gUsER."'";
		$gFLD.= ", FB_APPROVE";
		$gVAL.= ", '0'";
		$gFLD.= ", FS_KETERANGAN1";
		$gVAL.= ", '-'";
		$gFLD.= ", FS_KETERANGAN2";
		$gVAL.= ", '-'";
        InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
        

       
        if($radCaraBayar=="V2" && $fStaK=="0"){		
            //INSERT SEP
            //Tanggal TAT 
            $fTgTA = "";
            //TMT
            $fTgTM = "";
            //Cetak
            $fTgTC = "";



			$gTBL = "ta_registrasi_sep";
			$gFLD = "";
			$gVAL = "";
			
			$gFLD = "FS_KD_REG";
			$gVAL = "'".$tREG."'";
			
			$gFLD.= ", FS_MR";
			$gVAL.= ", '".$fNoRM."'";
			
			$gFLD.= ", FS_BPJS_NO_PESERTA";
			$gVAL.= ", '".$fBpJK."'";
			
			$gFLD.= ", FS_BPJS_NO_SEP";
			$gVAL.= ", ''";
			
			$gFLD.= ", FS_BPJS_NO_KTP";
			$gVAL.= ", '".$fKtEP."'";
			
			$gFLD.= ", FS_BPJS_ATAS_NAMA";
			$gVAL.= ", '".$fNmaB."'";
			
			$gFLD.= ", FS_BPJS_KD_STATUS";
			$gVAL.= ", '".$fStaK."'";
			
			$gFLD.= ", FS_BPJS_NM_STATUS";
			$gVAL.= ", '".$fStaD."'";
			
			$gFLD.= ", FS_BPJS_KD_KELAS";
			$gVAL.= ", '".$fKelK."'";
			
			$gFLD.= ", FS_BPJS_NM_KELAS";
			$gVAL.= ", '".$fKelD."'";
			
			$gFLD.= ", FS_BPJS_KD_KELOMPOK";
			$gVAL.= ", '".$fJnpK."'";
			
			$gFLD.= ", FS_BPJS_NM_KELOMPOK";
			$gVAL.= ", '".$fJnpD."'";
			
			$gFLD.= ", FS_BPJS_KD_PPKRJK";
			$gVAL.= ", '".$fFskK."'";
			
			$gFLD.= ", FS_BPJS_NM_PPKRJK";
			$gVAL.= ", '".$fFskD."'";
		
			$gFLD.= ", FS_TGL_TAT";
			$gVAL.= ", '".$fTgTA."'";
		
			$gFLD.= ", FS_TGL_TMT";
            $gVAL.= ", '".$fTgTM."'";
            
			$gFLD.= ", FS_TGL_TMC";
			$gVAL.= ", '".$fTgTC."'";
			
			//$SQG = "SET IDENTITY_INSERT ta_registrasi_sep ON";
			//$rsG= mssql_query($SQG);
			InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
        }
        //echo $fLaYK;
        //echo "Anda mendapat Nomor Antrian : ". $rAnt;		
		//$loket = 1 ;
		//$sql = 'INSERT INTO data_antrian (waktu,counter,status,nomor,fs_kd_layanan) VALUES ("'.date("Y-m-d H:i:s").'",'.$loket.',3,'.$rAnt.',"'.$fLaYK.'")';
		//echo $sql;
		//$results = $mysqli->query($sql);

}
?>

<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>ANTRIAN RSUD IMANUDDIN</title>
	    <link href="../assert/asset/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/asset/css/jumbotron-narrow.css" rel="stylesheet">
		<script src="../assert/asset/js/jquery.min.js"></script>
	</head>
	<style>
		.jumbotron{
			background-color:#000000;	
			
		}
		
		 #loading{
            width:50px;
            height: 50px;
            border: solid 5px #ccc;
            border-top-color: #FF6A00;
            border-radius: 100%;
            position: fixed;
            left:0;
            top:0;
            right:0;
            top:0;
            bottom: 0;
            margin:auto;

            animation: putar 2s linear infinite;            
        }

         @keyframes putar{
            from{transform: rotate(0deg)}
            to{transform:rotate(360deg)}
        } 

		#loket{
			display: none;
		}
				
	
	</style>
  	<body>
		<div class="container">
			
			<div class="jumbotron">
				<font color="#FFFFFF" size="45px">
					<h1 class="counter">
						<div id="loading"></div>
						<?php //echo $rAnt;?>			
					</h1>				
				</font>	
				<p>
					<a class="btn btn-lg btn-success next_queue" href="index.html" role="button">BERIKUTNYA &nbsp;		
					</a>
				</p>
			</div>
			
			<footer class="footer">
			<p>RSSI <?php echo date("Y");?></p>
			</footer>
			<div id="loket"><?php echo $hidden_loket;?></div>
		</div>
  	</body>
<html>
<script type="text/javascript">

$("document").ready(function(){
	
	$('.btn').html('Sedang Proses...');
	var loket = $('#loket').html();

	var uri = "../apps/daemon.php";
	var nomor_rm = "<?php echo $input_data;?>";
	console.log(nomor_rm);
	
    $.post( uri, {"loket" : loket,"nomor_rm": nomor_rm} ,	function( data ) {
		$(".jumbotron h1").html(data["next"]);	
		$('#loading').hide();
		$('.btn').html('BERIKUTNYA');
		console.log(loket);		
		goHome();
    },"json");



	//Tiga detik ke Home

	function goHome(){

		setInterval(function() {
			window.location = "index.html";  
		}, 10000);

	}
	

	//

	// var data = {"loket" : loket};
	// $.ajax({
	// 		type: 'GET',
	// 		url: 'http://localhost:5123/SIMRSSI/antrian_release2/apps/daemon.php',
	// 		data: data,		
	// 		dataType:'json',		
	// 		xhrFields: {withCredentials: false},
	// 		headers: {
	// 			'Access-Control-Allow-Credentials' : true,
	// 			'Access-Control-Allow-Origin':'*',
	// 			'Access-Control-Allow-Methods':'GET',
	// 			'Access-Control-Allow-Headers':'application/json',
	// 		},
	// 		success: function(data) {
	// 			console.log(data);
	// 		},
	// 		error: function(error) {
	// 			console.log("FAIL....=================");
	// 		}
	// 	});

	//

});

</script>

<?php
//Catatan :
/*
Tarif Registrasi = 0
Bayar Tunai      = 0
Tanggal Masuk dibuat otomatis tanggal sistem
fs_jam_masuk  dibuat otomatis JAM sistem
fs_kd_petugas = MESIN MANDIRI
fs_kd_jenis_inap / Jenis Inap = "" --> pada tabel kosong,1,2
fs_kd_kelas / kleas perawat = "" --> pada tabel : 006,002,004
fs_kd_cara_masuk_dk / Cara masuk = 8 --> Sendiri
fs_kd_karcis / Tarif Registrasi = ""   --> Tidak ada isian



Pertanyaan :
fn_kunjunganke query nya = MAX(fn_kunjunganke). 
    Isi field ini 1 dan 2, kebanyakan 1. akibatnya kunjungan selelu ke 2
    ada isinya 651 ???


PR:
Cari tabel cara masuk :
*/


?>