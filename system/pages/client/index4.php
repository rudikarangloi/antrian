<?php 
    session_start();
    include "../apps/mysql_connect.php";

	if (!isset($_SESSION["loket_client"])) 
	{
		$_SESSION["loket_client"] = 0;
    }
    

    //Teks Banner / Teks berjalan
    $sqla = " SELECT banner FROM tblbanner WHERE status=1 ";
	$rsta = $mysqli->query($sqla);			
	$rows = $rsta->fetch_array();
	if($rows['banner']){	
		$Banner = $rows['banner'];	
	}else{
        $Banner = ' ______ ';
    }

    // $rstbanner = $mysqli->query('SELECT banner FROM tblbanner WHERE status=1 ');
	// $rowBanner = $rstbanner->fetch_array();
	// if($rowBanner['banner']>0){
	// 	$Banner = $rowBanner['banner'];
	// }else{
	// 	$Banner = ' ______ ';
	// }
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
	    <link href="../assert/css/jumbotron-narrow-monitoring.css" rel="stylesheet">
	
		
		
	</head>
	<style>
		.jumbotron{
			background-color:#000000;
			min-height: 700px
			
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
		
		body{
			padding:60px;
		}
		
		#no_urut{
			
			font-size: 18em;	
			color:#FFFFFF		
		}
	
	</style>
  	<body>
    <div class="container">
		<div class="row ">	
			<div class="col-md-2">
			
			</div>
			
			<div class="col-md-6 text-center">
			
				<button class="btn btn-small btn-primary goHome" type="button" style="float:left;padding:20px;">
					Menu Utama  <img src="../assert/img/logorsud.png" width="40px" height="40px"> 
				</button>

               				
				<div class="jumbotron text-center">	
					<font color="#FFF">
						<h2 class="counter">
                        <marquee><?php echo $Banner;?></marquee>			
						</h2>
						<div id="loading"></div>
					</font>	
                   
                    <br />	 <br />	 <br />	 <br />	 

					<div id="no_urut">0</div>	

					<p>
						<a class="btn btn-lg btn-success next_queue" href="#" role="button">
                            Ambil Antrian &nbsp;
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
					</p>
				</div>
				
				
			</div>
			<div class="col-md-4">
				<form>

				</form>
				<footer class="footer">
				
				</footer>
			</div>
		</div>
    </div>
	
  	</body>	
	
	<script src="../assert/js/jquery.min.js"></script>	
	
  	<script type="text/javascript">
       
        
        $("document").ready(function()
        {
            $('#loading').hide();		
            $('.next_queue').show();           
            $(".peringatan").hide();
            
            // GET LAST COUNTER
            var data = {"loket": <?php echo $_SESSION["loket_client"];?>};

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "../apps/last_stage2.php",//request
                data: data,
                success: function(data) {
                    $(".jumbotron h1").html(data["next"]);
                    $("#no_urut").html(data["next"]);
                    
                }
            });

               
            // GET NEXT COUNTER
            $(".next_queue").click(function()
            {            
                loading.style.display = "block";  
                
                $('.btn').html('Proses..');
                $('.goHome').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
                $('.jumbotron h1').slideUp('slow');
                
                              
				var nomor_rm = '';
				var loket    = '1';
                var data = {"loket" : loket,"nomor_rm": nomor_rm};
                //console.log(' Before success : '+ loket);
                $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "../apps/daemon2.php",//request
                        data: data,					
                        success: function(data) {
                            //$('.jumbotron h1').fadeIn('slow');
                            $('.btn').html('BERIKUTNYA <span class="glyphicon glyphicon-chevron-right"></span>');
                            $('.goHome').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
                            
                            loading.style.display = "none";
                            //console.log(' ---> ' + data["next"]);
                            $('#loading').hide();
                            $(".jumbotron h1").html(data["next"]);
                            $("#no_urut").html(data["next"]);
                            if (data["idle"]=="TRUE") {
                                //$(".next_queue").hide();
                                clearInterval(timerId_adik);
                                adik_adudu(loket, data["next"]);
                            }
                        }
                });
                return false;
                                
            });
                                 
            $(".goHome").click(function(){
                window.location = "index.html";  
            });
            
        });
	</script>
</html>

