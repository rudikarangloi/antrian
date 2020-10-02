<?php
session_start();

?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Login with Qrcode</title>
	<style>
		.sidebar{ width: 350px; margin:auto; padding: 10px }
		.camera{ width: 610px; margin:auto; }
	</style>
	<script src="../assert/asset/js/jquery-3.4.1.min.js"></script>
<!-- scanner assert\asset\js  -->
<script src="../assert/asset/js/scanner/vendor/modernizr/modernizr.js"></script>
<script src="../assert/asset/js/scanner/vendor/vue/vue.min.js"></script>

<link rel="stylesheet" type="text/css" href="../assert/asset/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="../assert/asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../assert/asset/css/sweetalert.css">
<script src="../assert/asset/js/sweetalert.min.js"></script>

</head>
<body>

	  <!-- scan -->
  <div id="app" class="row box">
    
    <div class="col-xs-12 preview-container camera">
        <video id="preview" class="thumbnail"></video>
    </div>
	
	<div class="col-md-12 col-md-offset-4 sidebar">
		<!--
      <ul>
        <li v-if="cameras.length === 0" class="empty">No cameras found</li>
        <li v-for="camera in cameras">
          <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">
		  <input type="radio" class="align-middle mr-1" checked> {{ formatName(camera.name) }}</span>
          <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
          <a @click.stop="selectCamera(camera)"> <input type="radio" class="align-middle mr-1">@{{ formatName(camera.name) }}</a>  
          </span>
        </li>
      </ul>
      <div class="clearfix"></div>
	  -->
      <!-- form scan -->
		<form action="" method="POST" id="myForm">          
            <center><input type="text" name="qrcode" id="code" autofocus> </center>         
        </form>
		
		<?php
			if(!empty($_POST['qrcode'])){
				
				$qrcode = $_POST['qrcode'];
				$arr    = explode('=>',$qrcode);
				
				$username = $arr[0];
				$ktp      = $arr[1];
				//$ktp        = $qrcode;		
				
				header("location:cek_data_antrian.php?input_data=$ktp");
								
			}
			if(!empty($_GET['peringatan'])){
								
				if($_GET['peringatan'] == '1'){
					//echo 'Data tidak ditemukan';
					 echo "<script type='text/javascript'>
						  setTimeout(function () { 
							swal({
									title: 'Data tidak ditemukan',									
									type: 'warning',
									timer: 3200,
									showConfirmButton: true
								});   
						  },10);  
						  
						  </script>";
				}elseif($_GET['peringatan'] == '2') {
					$nama = $_GET['nama'];
					//echo "Nama : ".$nama." ";
					echo "<script type='text/javascript'>
						  setTimeout(function () { 
							swal({
									title: 'Data ditemukan',
									text:  'Nama : $nama',									
									type: 'success',
									timer: 3200,
									showConfirmButton: true
								});   
						  },10);  
						  
						  </script>";
				}
				
			    
				
			}
		?>
    </div>
	
  </div>
   <!-- scanner -->
<script src="../assert/asset/js/scanner/js/app.js"></script>
<script src="../assert/asset/js/scanner/vendor/instascan/instascan.min.js"></script>
<script src="../assert/asset/js/scanner/js/scanner.js"></script>


<script languange="javascript">
    //var objfrm = document.myfrm;

    //$("document").ready(function () {

    
	  //$('#input_data').focus().val($('#input_data').val());
	  
      //$('#peringatan').hide();     
	  function cek_data_antrians(){
      //$(".btn").click(function () {

        var input_data = $('#code').val();

        alert(input_data);


      //});
	  }
	  
	  function retrieve_sql_server(myData, data){
		
		var input_data = myData;
		var arrData = data;
		
		$.post("http://www.localhost:8090/sql_server_develop/konfirmasi_antrian.php", {
            "input_data": input_data,"arrData": arrData
          }, function (data) {

               //alert(data['msg'])	
            
          }, "json");
	  
	  }



   // });
  </script>
 </body>
 </html>