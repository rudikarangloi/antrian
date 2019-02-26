<!DOCTYPE html>
<html>
<?php
  session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="skin-black">
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong></strong></h3></div>
            <div class="panel-body">
              <form role="form" method="post">
                <div class="form-group">
                  <label for="txt_username">Username</label>
                  <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label for="txt_password">Password</label>
                  <input type="password" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password">
                </div>
                <button type="submit" class="btn btn-sm btn-primary" name="btn_login">Log in</button>
              </form>
            </div>
          </div>
          </div>
        </div>

      <?php
        include "pages/apps/mysql_connect.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];
           
            //$result = $mysqli->query("SELECT * from tbladmin where username = '$username' and password = '$password' and accounttype = 'Administrator' "); 
            $result = $mysqli->query("SELECT * from tbladmin where username = '$username' and password = '$password' "); 
            $numrow = mysqli_num_rows($result);          

            if($numrow > 0)
            {
                while($row = mysqli_fetch_array($result)){
                  //$_SESSION['role'] = "Administrator";
                  $_SESSION['role'] = $row['accounttype'];
                  $_SESSION['userid'] = $row['id'];
                }   
				if($_SESSION['role'] == 'Apotik'){
					header ('location: pages/dashboard/dashboard.php?jenis=apotik');
				}else{
					header ('location: pages/dashboard/dashboard.php');
				}
               
            }              
            else
                {
                  echo '<div style="text-align: center;color:red">User Name / Password belum sesuai</div>';
                }
             
        }
        
      ?>

    </body>
</html>