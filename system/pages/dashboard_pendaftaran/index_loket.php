<?php 
	session_start();
	if (!isset($_SESSION["loket_client"])) {
		$_SESSION["loket_client"] = NULL;
	}
	
	$_SESSION["nomor_loket"] = $_GET['nomor_loket'];
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>ADMIN RSUD IMANUDDIN</title>
	    <link href="../assert/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/css/jumbotron-narrow.css" rel="stylesheet">
		<script src="../assert/js/jquery.min.js"></script>
	</head>
		
	<style>
		#peringatan{
			color:red;
			font-size:14px;
		}
		
		.nomor_loket h1{
			font-size:14px;
		}
		
		#init_max_queque {
			
			color:#FFF;
			
		}
		#cekAbsent{
			
			font-size:20px;
			text-align:center;
			color:green;
		}
	</style>
  	<body>
    <div class="container">		
		<button class="btn btn-small btn-primary goRepeat" type="button" style="float:left;padding:20px;">
            Panggil Ulang  &nbsp;<span class="glyphicon glyphicon-volume-up"></span>   
        </button>	
						
    	<form>
    		<div style="background-color:#000000;"  class="jumbotron">
								
				<font color="#FFFFFF" size="45px">
					<h1 class="next">
						<span class="glyphicon glyphicon-book"></span>
					</h1>
					<p class="nomor_loket">
						<?php echo $_SESSION["nomor_loket"];?>
					</p>
					<p class="nama_loket">
						
					</p>
				</font>
				<button type="button" class="btn btn-lg btn-success next_getway">BERIKUTNYA <span class="glyphicon glyphicon-chevron-right"></span></button>
				<p id="peringatan">
					Nomor Antrian Dalam Panggilan.
				</p>			
				
				<h3 id="init_max_queque">
					0
				</h3>
				
				<button type="button" class="btn btn-lg btn-success tidak_hadir_getway">Tidak Hadir</button>
			
	      	</div>
    	</form>    	
		<p id="cekAbsent">Panggilan ulang </p>  
      	<footer class="footer">
        <p>RSSI <?php echo date("Y");?></p>
      	</footer>
    </div>
  	</body>
	<?php
		
	include "../apps/mysql_connect.php";
	
	$result = $mysqli->query('SELECT description FROM loket_antrian ORDER BY client'); 
	while ($rows = $result->fetch_array()) {	
		$result_array[] = $rows['description'];
	}
	
    $json_array = json_encode($result_array);
	?>
	
  	<script type="text/javascript">
	$("document").ready(function()
	{
		var nomor_loket = $(".nomor_loket").text();
		var gg= <?php echo $json_array; ?>		
		$('.nama_loket').html(gg[parseInt(nomor_loket,10)-1]);
			
		$('.nomor_loket').hide();
		$('#cekAbsent').hide();
		
		// GET LAST COUNTER
	    $.post( "../apps_pendaftaran/admin_gateway_loket.php", {"nomor_loket": nomor_loket}, function( data ) {
			$(".next").html(data['next']);
			$('#peringatan').hide();
		},"json");
		
	
	    // RESET 
		$(".next_getway").click(function(){
			var next_current = $(".next").text();
			var next_repeat = 0;
			$('#peringatan').hide();
			$('#cekAbsent').hide();
			console.log(nomor_loket)
			$.post( "../apps_pendaftaran/admin_gateway_loket.php", {"next_current": next_current,"next_repeat": next_repeat,"nomor_loket": nomor_loket}, function( data ) {
				if(data['peringatan'] == 1){
					$('#peringatan').show();
				}
				if(data['peringatan_absen'] != 0){
					$('#cekAbsent').show();
					$("#cekAbsent").html("Panggilan ulang nomor : "+ data['peringatan_absen']);	
				}
				$(".next").html(data['next']);
			},"json");
		});
		
		// Repeat 
		$(".goRepeat").click(function(){
			var next_current = $(".next").text();
			var next_repeat = $(".next").text();
			$('#peringatan').hide();
			console.log(nomor_loket)
			$.post( "../apps_pendaftaran/admin_gateway_loket.php", {"next_current": next_current,"next_repeat": next_repeat,"nomor_loket": nomor_loket}, function( data ) {
				if(data['peringatan'] == 1){
					$('#peringatan').show();
				}
				$(".next").html(data['next']);
			},"json");
		});
		
		$(".tidak_hadir_getway").click(function(){
			var next_current = $(".next").text();
			var next_repeat = 0;
			var next_absen = $(".next").text();
			$('#peringatan').hide();
			console.log(nomor_loket)
			$.post( "../apps_pendaftaran/admin_gateway_loket.php", {"next_current": next_current,"next_repeat": next_repeat,"nomor_loket": nomor_loket,"next_absen": next_absen}, function( data ) {
				if(data['peringatan'] == 1){
					$('#peringatan').show();
				}
				$(".next").html(data['next']);
			},"json");
		});
		
		
		setInterval(function() {
			$.post("../apps_pendaftaran/monitoring-data.php", function( data ){
				
				$("#init_max_queque").html('Antrian teratas ' + data["init_max_queque"] +' dari ' + data["init_count_queque"]);						
			

			}, "json"); 
		}, 1000);

	});
	</script>
</html>

