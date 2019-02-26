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
	    <title>ANTRIAN RSUD IMANUDDIN</title>
		
	    <link href="../assert/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/css/jumbotron-narrow.css" rel="stylesheet">
	
		
		
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
				
	
	</style>
  	<body>
    <div class="container">
		
        <button class="btn btn-small btn-primary goHome" type="button" style="float:left;padding:20px;">
            Menu Utama <span class="glyphicon glyphicon-home"></span>    
        </button>
		
        <div class="jumbotron">
			<font color="#FFFFFF" size="45px">
				<h1 class="counter">
					0			
				</h1>
				<div id="loading"></div>
			</font>		
			
			<p>
				<a class="btn btn-lg btn-success next_queue" href="#" role="button">BERIKUTNYA &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>			
				</a>
			</p>
      	</div>
    	<form>
        	<!--<label for="exampleInputEmail1" style="text-align: left;">
				<span class="glyphicon glyphicon-fullscreen">&nbsp;</span>SILAHKAN PILIH</label>--> 
        	<select class="form-control loket" name="loket" required			
        		<option value="0">-PILIH Apotik-</option>
			</select>
			
			<div id="radio_container"></div>			
			
			
        	<div class="alert alert-danger peringatan" role="alert">
        		<strong>PERINGATAN !!</strong>  Anda belum memilih Apotik.
        	</div>
    	</form>
      	<footer class="footer">
        <p>RSSI <?php echo date("Y");?></p>
      	</footer>
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

	<script src="../assert/js/jquery.min.js"></script>	
	

	
  	<script type="text/javascript">
	$("document").ready(function()
	{
		$('#loading').hide();
		
		//$(".try_queue").hide();
		var container = $('#radio_container');
		var jumlahRadio = 0;
		var gg= <?php echo $json_array; ?>
		//{1:'POLI ANAK',2:'POLI JANTUNG',3:'POLI UMUM',4:'POLI THT',5:'POLI PENYAKIT DALAM',6:'-',7:'-',8:'-',9:'-'};
		
					
		// LIST LOKET
		$.post("../apps/admin_init_apotik.php", function( data ){
			for (var i = 1; i <= data['client']; i++) { 					
				if ( i == <?php echo $_SESSION["loket_client"];?>){
					$('.loket').append('<option value="'+i+'" selected>'+gg[i-1]+'</option>');					
					//container.append('<input type="radio" checked class="rg" id="materialInline'+ i +'" name="loket" value="' + i + '"> <label class="form-check-label" for="materialInline'+ i +'">'+ gg[i-1] +'</label><br>');
					
					//
					
					/*			loket = '<button class="btn btn-success" type="button" style="width:220px;height:40px;padding:0px">'+
												'<font size=2>'+ gg[i-1] +'</font>'+
										'</button>&nbsp;';
											
					container.append(loket);*/
							
					//
				}
				else
				{
					$('.loket').append('<option value="'+i+'">'+gg[i-1]+'</option>');
					//container.append('<input type="radio" class="rg" id="materialInline'+ i +'" name="loket" value="' + i + '"> <label class="form-check-label" for="materialInline'+ i +'">'+ gg[i-1] +'</label><br>');
					//
					
					/*				loket = '<button class="btn btn-success" type="button" style="width:220px;height:40px;padding:0px">'+
												'<font size=2>'+ gg[i-1] +'</font>'+
										'</button>&nbsp;';
					container.append(loket);*/
							
					//
				}
				
				//jumlahRadio=3;
			}
		}, "json"); 

		//alert(jumlahRadio);
		// SET EXSIST session LOKET
		<?php if ($_SESSION["loket_client"] != 0) { ?>
		    	$(".peringatan").hide();
		<?php } else {?>
		    	//$(".peringatan").show();
		<?php } ?>
		
		$(".peringatan").hide();
		
		// GET LAST COUNTER
		var data = {"loket": <?php echo $_SESSION["loket_client"];?>};
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "../apps/last_stage_apotik.php",//request
			data: data,
			success: function(data) {
				$(".jumbotron h1").html(data["next"]);
				//$("#noAntrian").html(data["next"]);
				
			}
		});

		// NUMBER LOKET
		$('form radio').data('val',  $('form radio').val() );		
	    $('form select').data('val',  $('form select').val() );
		
		$('#radio_container').change(function(){	
			//set seassion or save	
			loading.style.display = "block";
			
			var myRadio = $("input[name=loket]");
			var checkedValue = myRadio.filter(":checked").val();
			
	    	var data = {"loket": checkedValue};
			
	    	if ( $(".loket").val() != 0 ) {
	    		$(".peringatan").hide();
	    	}else{
	    		$(".peringatan").show();
	    	}
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "../apps/set_loket_apotik.php",
				data: data,
				success: function(data) {
					loading.style.display = "none";
					$(".jumbotron h1").html(data["next"]);
				}
			});
	    	
		});

		
		
		
	    $('form select').change(function() {
	    	//set seassion or save
	    	var data = {"loket": $(".loket").val()};
			loading.style.display = "block";
			
	    	if ( $(".loket").val() != 0 ) {
	    		$(".peringatan").hide();
	    	}else{
	    		$(".peringatan").show();
	    	}
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "../apps/set_loket_apotik.php",
				data: data,
				success: function(data) {
					loading.style.display = "none";
					$(".jumbotron h1").html(data["next"]);
				}
			});
	    });
		
	    $('form select').keyup(function() {
	        if( $('form select').val() != $('form select').data('val') ){
	            $('form select').data('val',  $('form select').val() );
	            $(this).change();
	        }
	    });

	    // GET NEXT COUNTER
		$(".next_queue").click(function()
		{
			//var loket = $(".loket").val();
			loading.style.display = "block";  
			
			$('.btn').html('Proses..');
			$('.goHome').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
			//$('.jumbotron h1').slideUp('slow');
			
			// Ambil dari radio
			var myRadio = $("input[name=loket]");
			var loket = myRadio.filter(":checked").val();
			var nomor_rm = '';
			
			//Ambil dari Combo Box
			var loket = $(".loket").val();
			
			//alert(loket);
			if (loket==undefined) {
				$(".peringatan").show();
				alert('Pilih Nomor loket');
			}else{
				//var data = {"loket" : loket};
				var data = {"loket" : loket,"nomor_rm": nomor_rm};
				//console.log(' Before success : '+ loket);
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "../apps/daemon_apotik.php",//request
					data: data,					
					success: function(data) {
						//$('.jumbotron h1').fadeIn('slow');
						$('.btn').html('BERIKUTNYA <span class="glyphicon glyphicon-chevron-right"></span>');
						$('.goHome').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
						
						loading.style.display = "none";
						//console.log(' ---> ' + data["next"]);
						$('#loading').hide();
						$(".jumbotron h1").html(data["next"]);
						if (data["idle"]=="TRUE") {
							//$(".next_queue").hide();
							clearInterval(timerId_adik);
							adik_adudu(loket, data["next"]);
						}
					}
				});
				return false;
			}
			
		});

		var timerId=0;
		// ADUDU
		function adudu(loket, counter){
			timerId = setInterval(function() {
				 $.post("../apps/daemon_try_cek_apotik.php", { loket : loket, counter : counter }, function(msg){
					if(msg.huft == 2){
						//$(".try_queue").show();
						//$(".try_queue").hide();
					}
				},'JSON');
			}, 1000);
		 }
		
		var timerId_adik=0;
		// ADIK_ADUDU
		function adik_adudu(loket, counter){
			timerId_adik = setInterval(function() {
				 $.post("../apps/daemon_cek_apotik.php", { loket : loket, counter : counter }, function(msg){
					if(msg.huft == 2){
						$(".next_queue").show();
					}
				},'JSON');
			}, 1000);
		}

		// TRY CALL
		/*
		$(".try_queue").click(function(){
			var loket = $(".loket").val();
			if (loket==0) {
	    		$(".peringatan").show();
			}else{
				var counter = $(".counter").text();
				$.post("../apps/daemon_try.php", { loket : loket, counter : counter }, function(msg){
					if(msg.huft == 0){
						//$(".try_queue").hide();
						clearInterval(timerId);
						adudu(loket, counter);
					}
				},'JSON'); //request
				return false;
			}
		});	
		*/
		
		$(".goHome").click(function(){
			window.location = "../dashboard/dashboard.php?jenis=apotik";  
		});
		
	});
	</script>
</html>

