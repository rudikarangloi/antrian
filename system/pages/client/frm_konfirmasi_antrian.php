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
	
<!-- scanner -->
<script src="scanner/vendor/modernizr/modernizr.js"></script>
<script src="scanner/vendor/vue/vue.min.js"></script>
 <script src="../assert/asset/js/lib/jquery.js"></script>
</head>
<body>

	  <!-- scan -->
  <div id="app" class="row box">
    <div class="col-md-4 col-md-offset-4 sidebar">
      <ul>
        <li v-if="cameras.length === 0" class="empty">No cameras found</li>
        <li v-for="camera in cameras">
          <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active"><input type="radio" class="align-middle mr-1" checked> {{ formatName(camera.name) }}</span>
          <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
            <a @click.stop="selectCamera(camera)"> <input type="radio" class="align-middle mr-1">@{{ formatName(camera.name) }}</a>
          </span>
        </li>
      </ul>
      <div class="clearfix"></div>
      <!-- form scan -->
      <form action="cek_data_antrian.php" method="POST" id="myfrm">
          <fieldset class="scheduler-border">
            <legend class="scheduler-border"> Form Scan </legend>
            <input type="text" name="input_data" id="input_data" autofocus>
          </fieldset>
        </form>
		
		<?php
			if(!empty($_POST['qrcode'])){
				
				$con = mysqli_connect(
					'localhost', 
					'root', 
					'root', 
					'test');

				if(!$con){
					die("Database tidak ditemukan".mysqli_connect_error());
				}
				
				$qrcode = $_POST['qrcode'];
				$arr    = explode('|',$qrcode);
				
				$username = $arr[1];
				$pass     = $arr[2];
				
				$sql = " SELECT * FROM ms_users WHERE username = '$username' AND password = '$pass'	 ";
				//$sql = " SELECT * FROM ms_users ";		
				$resultSQL = mysqli_query($con, $sql);
				
				$result = mysqli_fetch_array($resultSQL);
				
				if(mysqli_num_rows($resultSQL) > 0){
					
					$_SESSION['username']= $result['username'];
					$_SESSION['password']= $result['password'];
				    //echo $result['createBy'].'-> '.$username .'-> '.$sql;
					header("location:admin.php");
				}
				
				//var_dump($resultSQL);
				//die();
			}
		?>		
		
    </div>
    <div class="col-xs-12 preview-container camera">
        <video id="preview" class="thumbnail"></video>
    </div>
   </div>
   <!-- scanner -->
<script src="scanner/js/app.js"></script>
<script src="scanner/vendor/instascan/instascan.min.js"></script>
<script src="scanner/js/scanner.js"></script>

 </body>
 </html>