<style>
			h1 {			  
			    font-family: "Arial Narrow";							
			}
</style>
    <div class="container">
    	<center>
	    	<div class="blog-header">
			    <img src="../assert/img/logorsud.png" width="100px;" style="margin: 8px;">
				
		    </div>
	    </center>
      	<div class="row loket">
      	</div>
	    
      <footer class="footer">
        <center><p>&copy; RSSI <?php echo date("Y");?></p></center>
      </footer> 
    </div>
  
	<?php
		
	include "../apps/mysql_connect.php";
	
	//$result = $mysqli->query('SELECT description FROM loket_antrian ORDER BY client'); 
	$result = $mysqli->query('SELECT description FROM client_antrian ORDER BY client'); 
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
			$.post("../apps/monitoring-daemon_preview.php", function( data ){			
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
											 ' jumbotron" style="padding-top:5px;padding-left:0px;padding-right:0px;padding-bottom:5px;">'+
												'<h1>'+data["init_counter"][i]+'</h1>'+											
												'<font size=2>'+                                              
                                                '<a href="index_loket.php?nomor_loket='+i+'" class="btn btn-primary"> '+ gg[i-1] +'</a>'+
                                                '</font>'+
											'</div>'+
										'</div>';
						$(".loket").append(loket);
					}

					tmp_loket = data['jumlah_loket'];
				}
				for (var i = 1; i <= data['jumlah_loket']; i++) { 					
					if (data["counter"]==i) {
						//$("."+i+" h1").html(data["next"]);
						$("."+i+" h1").html(data["nomor"]);                      
						console.log('1');
					}
				}
				
				if (data["next"]) {
				//if (data["nomor"]) {
					//var angka = data["next"];
					var angka = data["nomor"];
					// for (var i = 0 ; i < angka.toString().length; i++) {
					// 	$(".audio").append('<audio id="suarabel'+i+'" src="../audio/new/'+angka.toString().substr(i,1)+'.MP3" ></audio>');
					// };
					console.log('2');
					//$("."+jml_loket+" h1").html(data["nomor"]);	     //Tambahan
					//mulai(data["next"],data["counter"]);
					//mulai(data["nomor"],data["counter"],data["next"]);
				}else{
					for (var i = 1; i <= data['jumlah_loket']; i++) { 					
						if (data["counter"]==i) {
							console.log('3');
							//$("."+i+" h1").html(data["next"]);
							$("."+i+" h1").html(data["nomor"]);	                           
						}
					}
				};

			}, "json"); 
		}, 1000);
		//change
	});
	
		
	</script>


