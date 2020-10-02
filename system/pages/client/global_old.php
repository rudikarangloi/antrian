<?php
require "connfile-php7.php";
require "functionfile-php7.php";
header('Content-Type: text/xml');

$CrT = $_GET['CrT'];
$gMS = $_GET['gMST'];
$gVL = $_GET['gVL'];

if ($CrT=="BpJK")
{
	$sIdc = $_GET['sIdc'];
	$sKey = $_GET['sKey'];
	
	require "signature.php";
	
	$sCrt = $_GET['sCrt'];
	$sNom = $gVL;
	
	if ($sCrt=='ktp'){
		$sNik="nik/";
	}
	else {
		$sNik="nokartu/";
	}
		
	$url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/";
	
	$url.= $sNik;     
	$url.= $sNom;
	$url.= "/tglSEP/2020-02-14";
	
	$url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/Peserta/nik/3172030901760002/tglSEP/2020-02-14";
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,array("Accept: application/json\r\n" . "X-cons-id: ".$sIdc."\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature"));
	curl_setopt($curl, CURLOPT_GET, true);
	//curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	$json_response = curl_exec($curl);
	$error_msg = curl_error($curl);
	curl_close($curl);
	
	$ArrData = json_decode($json_response, true);
	$ArrCode = $ArrData[metaData]['code']; 
	$ArrMess = $ArrData[metaData]['message']; 
		
	if($ArrCode=="200")
	{
		echo '<output>';
		//echo '<ArrBPJS>tesberhasil</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrCode.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrMess.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['noKartu'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['nik'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['nama'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['statusPeserta']['kode'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['statusPeserta']['keterangan'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['hakKelas']['kode'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['hakKelas']['keterangan'].'</ArrBPJS>';

		echo '<ArrBPJS>'.$ArrData[response]['peserta']['jenisPeserta']['kode'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['jenisPeserta']['keterangan'].'</ArrBPJS>';
		
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['provUmum']['kdProvider'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['provUmum']['nmProvider'].'</ArrBPJS>';
		
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['tglTMT'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['tglTAT'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['tglCetakKartu'].'</ArrBPJS>';
		echo '<ArrBPJS> '.$ArrData[response]['peserta']['mr']['noTelepon'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$json_response.'</ArrBPJS>';
		echo '</output>';
	}
	else
	{		
		//$ArrCode = '123';
		//$ArrMess = 'Error';

		echo '<output>';
		echo '<ArrBPJS>'.' Signature : '.$encodedSignature.' gagalcoy '.$ArrData.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrCode.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrMess.'</ArrBPJS>';
		if ($sCrt=='ktp'){
			echo '<ArrBPJS>-</ArrBPJS>';
			echo '<ArrBPJS>'.$gVL.'</ArrBPJS>';
		}
		else
		{
			echo '<ArrBPJS>'.$gVL.'</ArrBPJS>';
			echo '<ArrBPJS>-</ArrBPJS>';
		}
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '</output>';
	}
}


/*
if ($CrT=="BpJK")
{
	$sIdc = $_GET['sIdc'];
	$sKey = $_GET['sKey'];
	require "signature.php";
	
	$sCrt = $_GET['sCrt'];
	$sNom = $gVL;
	
	if ($sCrt=='ktp'){
		$sNik="nik/";
	}
	else {
		$sNik="";
	}
	
	$url = $BaseURL.":".$BasPORT."/".$ServNMA."/peserta/peserta/";
	$url.= $sNik;
	$url.= $sNom;
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,array("Accept: application/json\r\n" . "X-cons-id: ".$sIdc."\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature"));
	curl_setopt($curl, CURLOPT_GET, true);
	$json_response = curl_exec($curl);
	curl_close($curl);
	
	$ArrData = json_decode($json_response, true);
	$ArrCode = $ArrData[metadata]['code']; 
	$ArrMess = $ArrData[metadata]['message']; 
	
	if($ArrCode=="200")
	{
		echo '<output>';
		echo '<ArrBPJS>'.$ArrCode.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrMess.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['noKartu'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['nik'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['nama'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['statusPeserta']['kode'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['statusPeserta']['keterangan'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['kelasTanggungan']['kdKelas'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['kelasTanggungan']['nmKelas'].'</ArrBPJS>';

		echo '<ArrBPJS>'.$ArrData[response]['peserta']['jenisPeserta']['kdJenisPeserta'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['jenisPeserta']['nmJenisPeserta'].'</ArrBPJS>';
		
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['provUmum']['kdProvider'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['provUmum']['nmProvider'].'</ArrBPJS>';
		
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['tglTMT'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['tglTAT'].'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrData[response]['peserta']['tglCetakKartu'].'</ArrBPJS>';
		
		echo '<ArrBPJS>'.$json_response.'</ArrBPJS>';
		echo '</output>';
	}
	else
	{
		$ArrCode = 'aaaaa';
		$ArrMess = 'GGAGAL';
		echo '<output>';
		echo '<ArrBPJS>'.$ArrCode.'</ArrBPJS>';
		echo '<ArrBPJS>'.$ArrMess.'</ArrBPJS>';
		if ($sCrt=='ktp'){
			echo '<ArrBPJS>-</ArrBPJS>';
			echo '<ArrBPJS>'.$gVL.'</ArrBPJS>';
		}
		else
		{
			echo '<ArrBPJS>'.$gVL.'</ArrBPJS>';
			echo '<ArrBPJS>-</ArrBPJS>';
		}
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '<ArrBPJS>-</ArrBPJS>';
		echo '</output>';
	}
}
*/

if ($CrT=="KwNK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_status_kawin_dk","ta_status_kawin_dk","fs_kd_status_kawin_dk",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}

if ($CrT=="JmNSK" || $CrT=="JmNLK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_jaminan","ta_jaminan","fs_kd_jaminan",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}

if ($CrT=="KrJK")
{
	$gVL = substr(str_repeat("0",3).$gVL,-3,3);
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_pekerjaan_dk","ta_pekerjaan_dk","fs_kd_pekerjaan_dk",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}
if ($CrT=="DiDK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_pendidikan_dk","ta_pendidikan_dk","fs_kd_pendidikan_dk",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}
if ($CrT=="AgAK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_agama","ta_agama","fs_kd_agama",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}
if ($CrT=="SkUK")
{
	$gVL = substr(str_repeat("0",3).$gVL,-3,3);
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_suku","ta_suku","fs_kd_suku",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}
if ($CrT=="KeLK")
{
	$rNmB = "";
	$rNmC = "";
	$rNmD = "";
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_kelurahan","ta_kelurahan","fs_kd_kelurahan",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA){
		$rNmB = str_replace('&','DAN',fGlobal("fs_nm_kecamatan","ta_kecamatan","fs_kd_kecamatan",substr($gVL,0,6),"=","",DatabaseSA,$ConSA,""));
		$rNmC = str_replace('&','DAN',fGlobal("fs_nm_kabupaten","ta_kabupaten","fs_kd_kabupaten",substr($gVL,0,4),"=","",DatabaseSA,$ConSA,""));
		$rNmD = str_replace('&','DAN',fGlobal("fs_nm_propinsi","ta_propinsi","fs_kd_propinsi",substr($gVL,0,2),"=","",DatabaseSA,$ConSA,""));
	}
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmB.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmC.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmD.'</ArrGLOB>';
	echo '</output>';
}

//TA REGISTRASI
if ($CrT=="LaYK")
{
	#$rNmA = str_replace('&','DAN',fGlobal("fs_nm_layanan","ta_layanan","fs_kd_layanan",$gVL,"=","",DatabaseSA,$ConSA,""));
	#$rInS = fGlobal("fs_kd_instalasi","ta_layanan","fs_kd_layanan",$gVL,"=","",DatabaseSA,$ConSA,"");
	
	#$rInD = str_replace('&','DAN',fGlobal("fs_nm_instalasi","ta_instalasi","fs_kd_instalasi",$rInS,"=","",DatabaseSA,$ConSA,""));
	#$rInB =  fGlobal("fs_ref_bpjs","ta_layanan","fs_kd_layanan",$gVL,"=","",DatabaseSA,$ConSA,"");
	
	$rNmA = "";
	$rInS = "";
	$rInD = "";
	$rInB = "";
	$eDT = fGlobal("fs_nm_layanan:fs_kd_instalasi:fs_ref_bpjs","ta_layanan","fs_kd_layanan",$gVL,"=","",DatabaseSA,$ConSA,"");
	if ($eDT){
		$eDT = explode(":",$eDT);
		$rNmA = str_replace('&','DAN',$eDT[0]);
		$rInS = $eDT[1];
		$rInD = str_replace('&','DAN',fGlobal("fs_nm_instalasi","ta_instalasi","fs_kd_instalasi",$rInS,"=","",DatabaseSA,$ConSA,""));
		$rInB = $eDT[2];
	}
	
	$rKcK="";
	$rKcD="";
	if (substr($gVL,0,2)=='RI'){
		$rKcK = "11";
	}
	else{
		$rKcK = $ArrKCS[$gVL];
	}
	
	if ($rKcK!=''){
		$rKcD = str_replace('&','DAN',fGlobal("fs_nm_karcis","ta_karcis","fs_kd_karcis",$rKcK,"=","",DatabaseSA,$ConSA,""));
	}
	
	if ($rNmA==""){$rNmA="none";}
	//if ($rInB=="---"){$rInB="";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '<ArrInsK>'.$rInS.'</ArrInsK>';
	echo '<ArrInsD>'.$rInD.'</ArrInsD>';
	echo '<ArrInsB>'.$rInB.'</ArrInsB>';
	
	echo '<ArrKcsK>'.$rKcK.'</ArrKcsK>';
	echo '<ArrKcsK>'.$rKcD.'</ArrKcsK>';
	echo '</output>';
	
}
if ($CrT=="KlSK")
{
	$gVL = substr(str_repeat("0",3).$gVL,-3,3);
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_kelas","ta_kelas","fs_kd_kelas",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="JmNK")
{
	$gVL = substr(str_repeat("0",3).$gVL,-3,3);
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_jaminan","ta_jaminan","fs_kd_jaminan",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="TrFK")
{
	$rNoM = 0;
	$gVL = substr("00".$gVL,-2,2);
	$rDTA = str_replace('&','DAN',fGlobal("fs_nm_karcis:fn_karcis","ta_karcis","fs_kd_karcis",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rDTA){
		$rDTA = explode(":",$rDTA);
		$rNmA = $rDTA[0];
		$rNoM = $rDTA[1];
	}
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '<ArrDatD>'.fConvertToRupiahBulat($rNoM).'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="MsKK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_cara_masuk_dk","ta_cara_masuk_dk","fs_kd_cara_masuk_dk",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="RjKK")
{
	$rNoF = "";
	$gVL = substr(str_repeat("0",3).$gVL,-3,3);
	$rDTA = str_replace('&','DAN',fGlobal("fs_nm_rujukan:fs_no_faskes_bpjs","ta_rujukan","fs_kd_rujukan",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rDTA){
		$rDTA = explode(":",$rDTA);
		$rNmA = $rDTA[0];
		$rNoF = $rDTA[1];
	}
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '<ArrDatD>'.$rNoF.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="InPK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_jenis_inap","ta_jenis_inap","fs_kd_jenis_inap",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="SmFK")
{
	$gVL = substr(str_repeat("0",2).$gVL,-2,2);
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_smf","ta_smf","fs_kd_smf",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="DiAK")
{
	$gVL = $gVL;
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_icd","tc_tbl_icd","fs_kd_icd",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="NoRM")
{
	$gVL = "620101200".substr(str_repeat("0",6).$gVL,-6,6);
	$rNma = "None";
	$rAlA = "";
	$rAlB = "";
	$rKot = "";
	$rJns = "";
	$rBpj = "";
	$rMax = "1";
	$rDTA = str_replace('&','DAN',fGlobal("fs_nm_pasien:fs_alm_pasien:fs_alm2_pasien:fs_kota_pasien:fb_jns_kelamin","tc_mr","fs_mr",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rDTA){
		$rDTA = explode(":",$rDTA);
		$rNma = $rDTA[0];
		$rAlA = $rDTA[1];
		$rAlB = $rDTA[2];
		$rKot = $rDTA[3];
		$rJns = fJnsKelamin($rDTA[4]);
		$rBpj = "";//$rDTA[5];
		
		$rMax = fGlobal("count(*)","ta_registrasi","fs_mr",$gVL,"=","",DatabaseSA,$ConSA,"");
		$rMax = (int)$rMax+1;
	}
	echo '<output>';
	echo '<ArrNoRM>'.parseRM($gVL).'</ArrNoRM>';
	echo '<ArrNoRM>'.$rNma.'</ArrNoRM>';
	echo '<ArrNoRM>'.$rAlA.'</ArrNoRM>';
	echo '<ArrNoRM>'.$rAlB.'</ArrNoRM>';
	echo '<ArrNoRM>'.$rKot.'</ArrNoRM>';
	echo '<ArrNoRM>'.$rJns.'</ArrNoRM>';
	echo '<ArrNoRM>'.$rMax.'</ArrNoRM>';
	echo '<ArrNoRM>'.$rBpj.'</ArrNoRM>';
	echo '</output>';
}
//TRS. TINDAKAN
if ($CrT=="TrKlSK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_kelas","ta_kelas","fs_kd_kelas",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="TrLaYK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_layanan","ta_layanan","fs_kd_layanan",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';	
}
if ($CrT=="TrTpTK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_TARIF_TIPE","ta_tarif_tipe","FS_KD_TARIF_TIPE",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';	
}
if ($CrT=="TrKdeK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_TARIF","ta_tarif","FS_KD_TARIF",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';	
}
if ($CrT=="TrDepK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_LAYANAN_DK","ta_layanan_dk","FS_KD_LAYANAN_DK",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="TrKeGK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_KEGIATAN_DK","tc_kegiatan_dk","FS_KD_KEGIATAN_DK",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}
if ($CrT=="TrAnEK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_GOL_ANS","ta_gol_anastesi","FS_KD_GOL_ANS",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';	
}
if ($CrT=="TrGoBK")
{
	$rNmA = str_replace('&','DAN',fGlobal("fs_nm_gol_bedah_dk","tc_gol_bedah_dk","fs_kd_gol_bedah_dk",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrDatK>'.$gVL.'</ArrDatK>';
	echo '<ArrDatD>'.$rNmA.'</ArrDatD>';
	echo '</output>';
}

function post_request($url,$port,$dataid,$tStamp,$encodedSignature,$dataBP,$referer = '')
{
	$url = parse_url($url);
	if ($url['scheme'] != 'http') {die('Error: Only HTTP request are supported !');}
	
	$host = $url['host'];
	$path = $url['path'];
	
	$fp = fsockopen($host, $port, $errno, $errstr, 50);
	
	if ($fp) 
	{
		fputs($fp, "PUT $path HTTP/1.1\r\n");
		fputs($fp, "Host: $host\r\n");
	
		if ($referer != '')
		
			fputs($fp, "Referer: $referer\r\n");
			fputs($fp, "x-cons-id: " . $dataid . "\r\n");
			fputs($fp, "x-timestamp: " . $tStamp . "\r\n");
			fputs($fp, "x-signature: " . $encodedSignature . "\r\n");
			fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: " . strlen($dataBP) . "\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $dataBP);
			
			$result = '';
			while (!feof($fp)) 
			{
				$result .= fgets($fp, 128);		##receive the results of the request, 128 char
			}
	}
	else 
	{
		return array('status' => 'err','error' => "$errstr ($errno)");
	}
	
	fclose($fp);
	
	$result = explode("\r\n\r\n", $result, 2);
	$header = isset($result[0]) ? $result[0] : '';
	$content = isset($result[1]) ? $result[1] : '';
	
	return array('status' => 'ok','header' => $header,'content' => $content);
}

if ($CrT=="LoKA" || $CrT=="LoKB" || $CrT=="LoKT")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_LAYANAN","ta_layanan","FS_KD_LAYANAN",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}

if ($CrT=="KoDK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_BED","ta_bed","FS_KD_BED",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	
	#$rKdK = str_replace('&','DAN',fGlobal("FS_KD_KAMAR","ta_bed","FS_KD_BED",$gVL,"=","",DatabaseSA,$ConSA,""));
	#$rNmK = str_replace('&','DAN',fGlobal("FS_NM_KAMAR","ta_kamar","FS_KD_KAMAR",$rKdK,"=","",DatabaseSA,$ConSA,""));
	#$rTrK = str_replace('&','DAN',fGlobal("FN_TARIF_1","ta_kamar","FS_KD_KAMAR",$rKdK,"=","",DatabaseSA,$ConSA,""));
	#$rKdB = str_replace('&','DAN',fGlobal("FS_KD_BANGSAL","ta_kamar","FS_KD_KAMAR",$rKdK,"=","",DatabaseSA,$ConSA,""));
	#$rNmB = str_replace('&','DAN',fGlobal("FS_NM_BANGSAL","ta_bangsal","FS_KD_BANGSAL",$rKdB,"=","",DatabaseSA,$ConSA,""));
	
	#echo '<ArrGLOB>'.$rNmK.'</ArrGLOB>';
	#echo '<ArrGLOB>'.$rNmB.'</ArrGLOB>';
	#echo '<ArrGLOB>'.fConvertToRupiahBulat($rTrK).'</ArrGLOB>';

		
	// $nSQ="SELECT P2.FS_NM_KAMAR, P3.FS_NM_BANGSAL, P2.FN_TARIF_1 
	// 		FROM ta_bed P1 
	// 		LEFT JOIN ta_kamar P2 ON P2.fs_kd_kamar=P1.fs_kd_kamar 
	// 		LEFT JOIN ta_bangsal P3 ON P3.fs_kd_bangsal=P2.fs_kd_bangsal 
	// 		WHERE P1.FS_KD_BED='$gVL'";
	// $nRs = mssql_query($nSQ);
	// $mRo = mssql_fetch_array($nRs);
	
	// echo '<ArrGLOB>'.$mRo[0].'</ArrGLOB>';
	// echo '<ArrGLOB>'.$mRo[1].'</ArrGLOB>';
	// echo '<ArrGLOB>'.fConvertToRupiahBulat($mRo[2]).'</ArrGLOB>';
	// echo '</output>';


	$nSQ   = "  SELECT P2.FS_NM_KAMAR, P3.FS_NM_BANGSAL, P2.FN_TARIF_1 
				FROM ta_bed P1 
				LEFT JOIN ta_kamar P2 ON P2.fs_kd_kamar=P1.fs_kd_kamar 
				LEFT JOIN ta_bangsal P3 ON P3.fs_kd_bangsal=P2.fs_kd_bangsal 
				WHERE P1.FS_KD_BED='$gVL'";
	$nRs   = sqlsrv_query($conn, $nSQ, array(), array('Scrollable' => 'static'));
	$mRo   = sqlsrv_num_rows($nRs);
	$datas  = sqlsrv_fetch_array($nRs);

	if ($mRo > 0) {
		
		echo '<ArrGLOB>'.$datas[0].'</ArrGLOB>';
		echo '<ArrGLOB>'.$datas[1].'</ArrGLOB>';
		echo '<ArrGLOB>'.fConvertToRupiahBulat($datas[2]).'</ArrGLOB>';
		echo '</output>';

	}else {
		
	}
	
}

if ($CrT=="BaNG")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_BANGSAL","ta_bangsal","FS_KD_BANGSAL",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '</output>';
}
if ($CrT=="TrNK")
{
	$rNmA = str_replace('&','DAN',fGlobal("FS_NM_TRANSPORT","ta_transport","FS_KD_TRANSPORT",$gVL,"=","",DatabaseSA,$ConSA,""));
	$rTrF = str_replace('&','DAN',fGlobal("FN_ONGKOS_KM","ta_transport","FS_KD_TRANSPORT",$gVL,"=","",DatabaseSA,$ConSA,""));
	if ($rNmA==""){$rNmA="none";}
	echo '<output>';
	echo '<ArrGLOB>'.$gVL.'</ArrGLOB>';
	echo '<ArrGLOB>'.$rNmA.'</ArrGLOB>';
	echo '<ArrGLOB>'.fConvertToRupiahBulat($rTrF).'</ArrGLOB>';
	echo '</output>';
}

?>