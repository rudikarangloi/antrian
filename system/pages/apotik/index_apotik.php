<?php 
  session_start();
  if (!isset($_SESSION["loket_client"])) 
  {
    $_SESSION["loket_client"] = 0;
  }
  
  if (!isset($_SESSION["nomor_loket"])){
	 $_SESSION["nomor_loket"] = 0;	
  }else{
	$_SESSION["nomor_loket"] = $_GET['nomor_loket'];
  }
  
  //$_SESSION["nomor_loket"] = $_GET['nomor_loket'];
  //echo $_SESSION["nomor_loket"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>Panggilan Antrian</title>
	    <link href="../assert/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/css/jumbotron-narrow-monitoring.css" rel="stylesheet">
		<script src="../assert/js/jquery.min.js"></script>
	</head>
  	<body>
    <div class="container">
    	<center>
	    	<div class="blog-header">
			    <img src="../assert/img/logorsud.png" width="100px;" style="margin: 8px;">
				<marquee behavior="alternate"><h3 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;"><b></b></h3>  </marquee>
		    </div>
	    
      	<div class="row loket">
      	</div>
        <div class="audio">
            <audio id="in" src="../audio/new/in.wav"></audio>
            <audio id="out" src="../audio/new/out.wav"></audio>
            <audio id="suarabel" src="../audio/new/Airport_Bell.mp3"></audio>
            <audio id="suarabelnomorurut" src="../audio/new/nomor-antrian.mp3"></audio> 
            <audio id="suarabelsuarabelloket" src="../audio/new/konter.MP3"></audio> 
            <audio id="belas" src="../audio/new/belas.MP3"></audio> 
            <audio id="sebelas" src="../audio/new/sebelas.MP3"></audio> 
            <audio id="puluh" src="../audio/new/puluh.MP3"></audio> 
            <audio id="sepuluh" src="../audio/new/sepuluh.MP3"></audio> 
            <audio id="ratus" src="../audio/new/ratus.MP3"></audio> 
            <audio id="seratus" src="../audio/new/seratus.MP3"></audio> 
            <audio id="suarabelloket1" src="../audio/new/1.MP3"></audio> 
            <audio id="suarabelloket2" src="../audio/new/2.MP3"></audio> 
            <audio id="suarabelloket3" src="../audio/new/3.MP3"></audio> 
            <audio id="suarabelloket4" src="../audio/new/4.MP3"></audio> 
            <audio id="suarabelloket5" src="../audio/new/5.MP3"></audio> 
            <audio id="suarabelloket6" src="../audio/new/6.MP3"></audio> 
            <audio id="suarabelloket7" src="../audio/new/7.MP3"></audio> 
            <audio id="suarabelloket8" src="../audio/new/8.MP3"></audio> 
            <audio id="suarabelloket9" src="../audio/new/9.MP3"></audio> 
            <audio id="suarabelloket10" src="../audio/new/sepuluh.MP3"></audio> 
            <!--<audio id="loket" src="../audio/new/loket.mp3"></audio> -->
			<audio id="loket" src="../audio/new/loket_pendaftaran.mp3"></audio> 
            
          	<audio id="suarabelloket1_umum"                        src="../audio/poli/obat.MP3"></audio> 			
			<audio id="suarabelloket2_penyakit_dalam"              src="../audio/poli/racik.MP3"></audio> 
            <audio id="suarabelloket3_bedah"                       src="../audio/poli/3_bedah.MP3"></audio> 
            <audio id="suarabelloket4_kebidanan_dan_kandungan"     src="../audio/poli/4_kebidanan_dan_kandungan.MP3"></audio> 
            <audio id="suarabelloket5_anak"                        src="../audio/poli/5_anak.MP3"></audio> 
            <audio id="suarabelloket6_mata"                        src="../audio/poli/6_mata.MP3"></audio> 
            <audio id="suarabelloket7_gigi_dan_mulut"              src="../audio/poli/7_gigi_dan_mulut.MP3"></audio> 
            <audio id="suarabelloket8_rehabilitasi medik"          src="../audio/poli/8_rehabilitasi medik.MP3"></audio> 
            <audio id="suarabelloket9_psikologi"                   src="../audio/poli/9_psikologi.MP3"></audio> 
            <audio id="suarabelloket10_tht"                        src="../audio/poli/10_tht.MP3"></audio> 
            <audio id="suarabelloket11_neorologi"                  src="../audio/poli/11_neorologi.MP3"></audio> 
            <audio id="suarabelloket12_kulit_dan_kelamin"          src="../audio/poli/12_kulit_dan_kelamin.MP3"></audio> 
            <audio id="suarabelloket13_kia_dan_kb"                 src="../audio/poli/13_kia_dan_kb.MP3"></audio> 
            <audio id="suarabelloket14_gizi"                       src="../audio/poli/14_gizi.MP3"></audio> 
            <audio id="suarabelloket15_klinik_kesehatan_jiwa"      src="../audio/poli/15_klinik_kesehatan_jiwa.MP3"></audio> 
            <audio id="suarabelloket16_klinik_tumbuh_kembang_anak" src="../audio/poli/16_klinik_tumbuh_kembang_anak.MP3"></audio> 
            <audio id="suarabelloket17_klinik_spesialis_gigi"      src="../audio/poli/17_klinik_spesialis_gigi.MP3"></audio> 
            
        </div>
      <footer class="footer">
        <center><p class="tesangka"><?php //echo date("Y");?></p></center>
      </footer> 
	  </center>
    </div>
  	</body>
	<?php
		
	include "../apps/mysql_connect.php";
	
	$result = $mysqli->query('SELECT description FROM client_antrian_apotik ORDER BY client'); 
	while ($rows = $result->fetch_array()) {	
		$result_array[] = $rows['description'];
	}
	
    $json_array = json_encode($result_array);
	
	$nomorPoli = intval($_SESSION["nomor_loket"]) - 1;
	?>
  	<script type="text/javascript">
	  $("document").ready(function(){
			var tmp_loket=0;
			var jml_loket=1;
			var gg= <?php echo $json_array; ?>
			//var gg={1:'POLI ANAK',2:'POLI JANTUNG',3:'POLI UMUM',4:'POLI THT',5:'POLI PENYAKIT DALAM',6:'-',7:'-',8:'-',9:'-'};
			//var gg={1:'SATU',2:'DUA',3:'TIGA',4:'EMPAT',5:'LIMA',6:'ENAM',7:'TUJUH',8:'DELAPAN',9:'SEMBILAN'};
			
			setInterval(function() {
			  $.post("../apps/monitoring-daemon-apotik.php", function( data ){
				if(tmp_loket!=data['jumlah_loket']){
				  $(".col-md-3").remove();
				  tmp_loket=0;
				  dkolom = 12 / data['jumlah_loket'];
				}
				
				//Hanya sekali dijalankan ketika tmp_loket = 0. Berikutnya tmp_loket terisi
				if (tmp_loket==0) {
						for (var i = 1; i<= data['jumlah_loket']; i++) {
								loket = '<div class=col-md-'+dkolom+'>'+
											'<div class="'+ i +
											 ' jumbotron" style="padding-top:20px;padding-bottom:20px;">'+
												'<h1> '+data["init_counter"][i]+' </h1>'+
												'<button class="btn btn-danger" type="button"><span class="glyphicon glyphicon-credit-card">&nbsp;</span>'+ gg[<?php echo $nomorPoli;?>] +'</button>'+
											'</div>'+
										'</div>';
								$(".loket").append(loket);
						}

				  tmp_loket = data['jumlah_loket'];
				}
				
				for (var i = 1; i <= data['jumlah_loket']; i++) {           
				  if (data["counter"]==i) {
					$("."+i+" h1").html(data["nomor"]);					
				  }
				}
				
				if (data["nomor"]) {
				  var angka = data["nomor"];
				  for (var i = 0 ; i < angka.toString().length; i++) {
					$(".audio").append('<audio id="suarabel'+i+'" src="../audio/new/'+angka.toString().substr(i,1)+'.MP3" ></audio>');
				  };
				  //mulai(data["next"],data["counter"],data["nomor"]);				  
				  $("."+jml_loket+" h1").html(data["nomor"]);	
				  //$('.tesangka').html(data["nomor"]);
				  mulai(data["nomor"],data["counter"],data["next"]);
				}else{
				  for (var i = 1; i <= data['jumlah_loket']; i++) {           
					if (data["counter"]==i) {
					  $("."+i+" h1").html(data["nomor"]);					 
					}
				  }
				};

			  }, "json"); 
			}, 1000);
			//change
	  });
  
  function mulai(urut, loket, nomor){
    var totalwaktu = 8568.163;

    switch(loket) {
					  case '1':	loket = '1_umum';	break;
					  case '2':	loket = '2_penyakit_dalam';	break;
					  case '3':	loket = '3_bedah';	break;
					  case '4':	loket = '4_kebidanan_dan_kandungan';break;
					  case '5':	loket = '5_anak';	break;  
					  case '6':	loket = '6_mata';	break;  
					  case '7':	loket = '6_mata';	break;		  
					  case '8':	loket = '8_rehabilitasi medik';	break;
					  case '9':	loket = '9_psikologi';	break;
					 case '10': loket = '10_tht';	break;
					 case '11':	loket = '11_neorologi';	break;
					 case '12':	loket = '12_kulit_dan_kelamin';	break;
					 case '13':	loket = '13_kia_dan_kb'; break;
					 case '14':	loket = '14_gizi';	break;
					 case '15':	loket = '15_klinik_kesehatan_jiwa';	break;
					 case '16':	loket = '16_klinik_tumbuh_kembang_anak';	break;
					 case '17':	loket = '17_klinik_spesialis_gigi';	break;
					 default  :	loket = '10_tht';
		}
    
    document.getElementById('in').pause();
    document.getElementById('in').currentTime=0;
    document.getElementById('in').play();
    totalwaktu=document.getElementById('in').duration*1000; 
    setTimeout(function() {
        document.getElementById('suarabelnomorurut').pause();
        document.getElementById('suarabelnomorurut').currentTime=0;
        document.getElementById('suarabelnomorurut').play();
    }, totalwaktu);
    totalwaktu=totalwaktu+1000;
    if(urut<10){
      setTimeout(function() {
          document.getElementById('suarabel0').pause();
          document.getElementById('suarabel0').currentTime=0;
          document.getElementById('suarabel0').play();
        }, totalwaktu);
      totalwaktu=totalwaktu+1000;
      setTimeout(function() {
          document.getElementById('loket').pause();
          document.getElementById('loket').currentTime=0;
          document.getElementById('loket').play();
        }, totalwaktu);
      totalwaktu=totalwaktu+1000;
      setTimeout(function() {
          document.getElementById('suarabelloket'+loket+'').pause();
          document.getElementById('suarabelloket'+loket+'').currentTime=0;
          document.getElementById('suarabelloket'+loket+'').play();
        }, totalwaktu);
      totalwaktu=totalwaktu+1000;
      setTimeout(function() {
          for (var i = 0 ; i < urut.toString().length; i++) {
            $("#suarabel"+i+"").remove();
          };
        }, totalwaktu);
      totalwaktu=totalwaktu+1000;
    }else if(urut==10){
        setTimeout(function() {
            document.getElementById('sepuluh').pause();
            document.getElementById('sepuluh').currentTime=0;
            document.getElementById('sepuluh').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if(urut ==11){
        setTimeout(function() {
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').currentTime=0;
            document.getElementById('sebelas').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if(urut < 20){
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('belas').pause();
            document.getElementById('belas').currentTime=0;
            document.getElementById('belas').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if(urut < 100){
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if(urut==100){
      setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut < 110) {
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut == 110) {
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sepuluh').pause();
            document.getElementById('sepuluh').currentTime=0;
            document.getElementById('sepuluh').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut == 111) {
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('sebelas').pause();
            document.getElementById('sebelas').currentTime=0;
            document.getElementById('sebelas').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut < 120) {
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel2').pause();
            document.getElementById('suarabel2').currentTime=0;
            document.getElementById('suarabel2').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('belas').pause();
            document.getElementById('belas').currentTime=0;
            document.getElementById('belas').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut == 120) {
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut < 200) {
        setTimeout(function() {
            document.getElementById('seratus').pause();
            document.getElementById('seratus').currentTime=0;
            document.getElementById('seratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabel1').pause();
            document.getElementById('suarabel1').currentTime=0;
            document.getElementById('suarabel1').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('puluh').pause();
            document.getElementById('puluh').currentTime=0;
            document.getElementById('puluh').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        
        if (urut%10!=0) {
          setTimeout(function() {
              document.getElementById('suarabel2').pause();
              document.getElementById('suarabel2').currentTime=0;
              document.getElementById('suarabel2').play();
            }, totalwaktu);
          totalwaktu=totalwaktu+1000;
        }

        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if (urut == 200) {
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('ratus').pause();
            document.getElementById('ratus').currentTime=0;
            document.getElementById('ratus').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }else if(urut < 999){
        setTimeout(function() {
            document.getElementById('suarabel0').pause();
            document.getElementById('suarabel0').currentTime=0;
            document.getElementById('suarabel0').play();
        }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        if (urut.toString().substr(1,1) == 0 && urut.toString().substr(2,1)==0) { // 200 300 400 ..
          setTimeout(function() {
              document.getElementById('ratus').pause();
              document.getElementById('ratus').currentTime=0;
              document.getElementById('ratus').play();
            }, totalwaktu);
          totalwaktu=totalwaktu+1000;
        } else if(urut.toString().substr(1,1) == 0 && urut.toString().substr(2,1)!=0){ // 201 304 405 506
          setTimeout(function() {
              document.getElementById('ratus').pause();
              document.getElementById('ratus').currentTime=0;
              document.getElementById('ratus').play();
            }, totalwaktu);
          totalwaktu=totalwaktu+1000;
          setTimeout(function() {
              document.getElementById('suarabel2').pause();
              document.getElementById('suarabel2').currentTime=0;
              document.getElementById('suarabel2').play();
            }, totalwaktu);
          totalwaktu=totalwaktu+1000;
        }else if(urut.toString().substr(1,1) != 0 && urut.toString().substr(2,1)==0){ //210 250 230
          if(urut.toString().substr(1,1) == 1){ //210
            setTimeout(function() {
              document.getElementById('ratus').pause();
              document.getElementById('ratus').currentTime=0;
              document.getElementById('ratus').play();
            }, totalwaktu);
            totalwaktu=totalwaktu+1000;
            setTimeout(function() {
              document.getElementById('sepuluh').pause();
              document.getElementById('sepuluh').currentTime=0;
              document.getElementById('sepuluh').play();
            }, totalwaktu);
            totalwaktu=totalwaktu+1000;
          }else{
            setTimeout(function() {
              document.getElementById('ratus').pause();
              document.getElementById('ratus').currentTime=0;
              document.getElementById('ratus').play();
            }, totalwaktu);
            totalwaktu=totalwaktu+1000;
            setTimeout(function() {
              document.getElementById('suarabel1').pause();
              document.getElementById('suarabel1').currentTime=0;
              document.getElementById('suarabel1').play();
            }, totalwaktu);
            totalwaktu=totalwaktu+1000;
            setTimeout(function() {
              document.getElementById('puluh').pause();
              document.getElementById('puluh').currentTime=0;
              document.getElementById('puluh').play();
            }, totalwaktu);
            totalwaktu=totalwaktu+1000;
          }
        }else if(urut.toString().substr(1,1) != 0 && urut.toString().substr(2,1)!=0){
          if (urut.toString().substr(1,1)==1) {
            if (urut.toString().substr(2,1)==1) { // 211 311 411 511
              setTimeout(function() {
                  document.getElementById('ratus').pause();
                  document.getElementById('ratus').currentTime=0;
                  document.getElementById('ratus').play();
                }, totalwaktu);
              totalwaktu=totalwaktu+1000;
              setTimeout(function() {
                  document.getElementById('sebelas').pause();
                  document.getElementById('sebelas').currentTime=0;
                  document.getElementById('sebelas').play();
                }, totalwaktu);
              totalwaktu=totalwaktu+1000;
            }else{ //212 215 219
              setTimeout(function() {
                  document.getElementById('ratus').pause();
                  document.getElementById('ratus').currentTime=0;
                  document.getElementById('ratus').play();
                }, totalwaktu);
              totalwaktu=totalwaktu+1000;
              setTimeout(function() {
                  document.getElementById('suarabel2').pause();
                  document.getElementById('suarabel2').currentTime=0;
                  document.getElementById('suarabel2').play();
                }, totalwaktu);
              totalwaktu=totalwaktu+1000;
              setTimeout(function() {
                  document.getElementById('belas').pause();
                  document.getElementById('belas').currentTime=0;
                  document.getElementById('belas').play();
                }, totalwaktu);
              totalwaktu=totalwaktu+1000;
            }
          }else{
            setTimeout(function() {
                document.getElementById('ratus').pause();
                document.getElementById('ratus').currentTime=0;
                document.getElementById('ratus').play();
              }, totalwaktu);
            totalwaktu=totalwaktu+1000;
            setTimeout(function() {
                document.getElementById('suarabel1').pause();
                document.getElementById('suarabel1').currentTime=0;
                document.getElementById('suarabel1').play();
              }, totalwaktu);
            totalwaktu=totalwaktu+1000;
            setTimeout(function() {
                document.getElementById('puluh').pause();
                document.getElementById('puluh').currentTime=0;
                document.getElementById('puluh').play();
              }, totalwaktu);
            totalwaktu=totalwaktu+1000;
            if (urut%10!=0) {
              setTimeout(function() {
                  document.getElementById('suarabel2').pause();
                  document.getElementById('suarabel2').currentTime=0;
                  document.getElementById('suarabel2').play();
                }, totalwaktu);
              totalwaktu=totalwaktu+1000;
            }
          }
        }

        setTimeout(function() {
            document.getElementById('loket').pause();
            document.getElementById('loket').currentTime=0;
            document.getElementById('loket').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            document.getElementById('suarabelloket'+loket+'').pause();
            document.getElementById('suarabelloket'+loket+'').currentTime=0;
            document.getElementById('suarabelloket'+loket+'').play();
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
            for (var i = 0 ; i < urut.toString().length; i++) {
              $("#suarabel"+i+"").remove();
            };
          }, totalwaktu);
        totalwaktu=totalwaktu+1000;
    }

    setTimeout(function(){
      document.getElementById('out').pause();
      document.getElementById('out').currentTime=0;
      document.getElementById('out').play();
    }, totalwaktu);
	
    totalwaktu=totalwaktu+1000;
	
    setTimeout(function() {
      $.post("../apps/monitoring-daemon-result-apotik.php", { id : nomor }, function(data){
        if (!data.status) {
          console.log(data.status);   
        }
      }, 'json');
    }, totalwaktu);
    totalwaktu=totalwaktu+1000;
  }
  </script>
</html>

