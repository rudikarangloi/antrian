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


//Tarif Registrasi
$nTrFK = 0;
//$tNmP  = fGlobal("fs_nm_pasien","tc_mr","fs_mr",$fNoRM,"=","",DatabaseSA,$ConSA,"");

$sql = "SELECT FS_NM_PASIEN AS FldD FROM tc_mr WHERE FS_MR = '". $fNoRM ."'";
$rstClient = $mysqli->query($sql);			
$rowClient = $rstClient->fetch_array();
if($rowClient['FldD']){
	$tNmP= $rowClient['FldD'];
} 


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


//$KnJK = fGlobal("isnull(max(fn_kunjunganke),0)","ta_registrasi","fs_mr",$fNoRM,"=","",DatabaseSA,$ConSA,"");
$KnJK = 1;
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
//$PrmA = fGlobal("fn_registrasi_masuk","t_parameter","fn_registrasi_masuk","%","LIKE","",DatabaseSA,$ConSA,"");
$PrmA = 1;
$PrmB = $PrmA+1;
$tNEW = substr(str_repeat('0',10).$PrmA,-10,10);
$tREG = $tNEW;

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