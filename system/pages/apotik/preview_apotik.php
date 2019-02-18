<?php 
  session_start();
  if (!isset($_SESSION["loket_client"])) 
  {
    $_SESSION["loket_client"] = 0;
  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>Monitoring Antrian</title>
	    <link href="../assert/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/css/jumbotron-narrow-monitoring.css" rel="stylesheet">
		<script src="../assert/js/jquery.min.js"></script>
	</head>
  	<body>
    <div class="container">
    	<center>
			<!--
	    	<div class="blog-header">
			    <img src="../assert/img/logorsud.png" width="100px;" style="margin: 8px;">
				<marquee behavior="alternate"><h3 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;"><b></b></h3>  </marquee>
		    </div>
			-->
	    
      	<div class="row loket">
      	</div>
	   
      <footer class="footer">
        <center><p><?php //echo date("Y");?></p></center>
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
	?>
  	<script type="text/javascript">
	  $("document").ready(function(){
			var tmp_loket=0;
			var gg= <?php echo $json_array; ?>
			//var gg={1:'POLI ANAK',2:'POLI JANTUNG',3:'POLI UMUM',4:'POLI THT',5:'POLI PENYAKIT DALAM',6:'-',7:'-',8:'-',9:'-'};
			//var gg={1:'SATU',2:'DUA',3:'TIGA',4:'EMPAT',5:'LIMA',6:'ENAM',7:'TUJUH',8:'DELAPAN',9:'SEMBILAN'};
			
			setInterval(function() {
			  
			  $.post("../apps/monitoring-daemon_preview-apotik.php", function( data ){
				
				if(tmp_loket!=data['jumlah_loket']){					
				  $(".col-md-3").remove();
				  tmp_loket=0;
				  if(data['jumlah_loket'] >12){
					  dkolom = 3;
				  }else{
					  dkolom = 12 / data['jumlah_loket'];
				  }
				  
				
				}
				if (tmp_loket==0) {
						for (var i = 1; i<= data['jumlah_loket']; i++) {
								loket = '<div class=col-md-'+dkolom+'>'+
											'<div class="'+ i +
											 ' jumbotron" style="padding-top:5px;padding-bottom:5px;">'+
												'<h1> '+data["init_counter"][i]+' </h1>'+
												'<button class="btn btn-success" type="button" style="height:40px;padding-top:0">'+
												'<font size=2>'+ gg[i-1] +'</font></button>'+
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
				
				
				if (data["next"]) {
				  var angka = data["next"];
				  for (var i = 0 ; i < angka.toString().length; i++) {
					//$(".audio").append('<audio id="suarabel'+i+'" src="../audio/new/'+angka.toString().substr(i,1)+'.MP3" ></audio>');
				  };
				  //mulai(data["next"],data["counter"]);
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
  
 
  </script>
</html>

