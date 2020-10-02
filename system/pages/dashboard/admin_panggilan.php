


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
	
    setInterval(function() {
      $.post("../apps/setting_loket.php", function( data ){
        if(tmp_loket!=data['jumlah_loket']){
          $(".col-md-3").remove();
          tmp_loket=0;
		  if(data['jumlah_loket'] >12){
				dkolom = 3;
		  }else{
				dkolom = 12 / data['jumlah_loket'];
		  }
        }
        /*
        if (tmp_loket==0) {
          for (var i = 1; i<= data['jumlah_loket']; i++) {
              loket = '<div class=col-md-'+dkolom+'>'+
                        '<div class="'+ i +
                        ' jumbotron" style="padding-top:5px;padding-bottom:5px;">'+
                          '<h1> '+data["init_counter"][i]+' </h1>'+
                          '<button class="btn btn-primary" type="button" style="height:40px;padding-top:0">'+
                          '<a href="index.php?nomor_loket='+i+'" class="btn btn-primary"> '+ gg[i-1] +'</a>'+
                          
                        '</div>'+
                      '</div>';
              $(".loket").append(loket);
          }

          tmp_loket = data['jumlah_loket'];
        }
        */

        if (tmp_loket==0) {
                  for (var i = 1; i<= data['jumlah_loket']; i++) {
                      loket = '<div class=col-md-'+dkolom+'>'+
                                '<div class="'+ i +
                                ' jumbotron" style="padding-top:5px;padding-bottom:10px;">'+
                                  '<h1> '+data["init_counter"][i]+' </h1>'+
                                  
                                  '<button class="btn btn-primary" type="button">'+	                                   
                                    '<a href="index_poli.php?nomor_loket='+i+'" class="btn btn-primary"> '+ gg[i-1] +'</a>'+
                                  '</button>'+
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
           
          };
         
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


