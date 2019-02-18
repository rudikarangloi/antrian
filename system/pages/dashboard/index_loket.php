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
	</style>
  	<body>
    <div class="container">
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
	      	</div>
    	</form>
    	<br/>
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
		//var gg={1:'POLI ANAK',2:'POLI JANTUNG',3:'POLI UMUM',4:'POLI THT',5:'POLI PENYAKIT DALAM',6:'-',7:'-',8:'-',9:'-'};
		$('.nama_loket').html(gg[parseInt(nomor_loket,10)-1]);
		//$('.nama_loket').html('LOKET PENDAFTARAN');
	
		$('.nomor_loket').hide();
		
		// GET LAST COUNTER
	    $.post( "../apps/admin_gateway_loket.php", {"nomor_loket": nomor_loket}, function( data ) {
			$(".next").html(data['next']);
			$('#peringatan').hide();
		},"json");
		
	
	    // RESET 
		$(".next_getway").click(function(){
			var next_current = $(".next").text();
			$('#peringatan').hide();
			console.log(nomor_loket)
			$.post( "../apps/admin_gateway_loket.php", {"next_current": next_current,"nomor_loket": nomor_loket}, function( data ) {
				if(data['peringatan'] == 1){
					$('#peringatan').show();
				}
				$(".next").html(data['next']);
			},"json");
		});

	});
	</script>
</html>

